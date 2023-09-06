<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AttandanceResource;

class AttendancesController extends Controller
{
    public function absenMasuk(Request $request)
    {
        $user = auth()->user();
        //get User from token
        $userId = $user->id;
        $lokasi = $request->input('lokasi_masuk');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $namaDevice = $request->input('device');
        
        $validator = Validator::make(
            $request->all(),
            [
                'lokasi_masuk' => 'required',   
                'latitude' => 'required',
                'longitude' => 'required',
                'device' => 'required',
                'evidence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [            
                'lokasi_masuk.required' => 'Lokasi harus diisi.',
                'evidence.required' => 'Gambar bukti harus diunggah.',
                'evidence.image' => 'Bukti harus berupa gambar.',
                'evidence.mimes' => 'Format gambar tidak valid. Hanya diperbolehkan jpeg, png, jpg, gif.',
                'evidence.max' => 'Ukuran gambar terlalu besar. Maksimum 2MB.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = ['message' => $errors];
            return response()->json($data, 422);
        } else {
            $currentDate = Carbon::now()->format('Y-m-d');
            $attendance = Attendance::where('user_id', $userId)
                ->whereDate('tanggal', $currentDate)
                ->first();
            $absenSchedule = collect(
                Schedule::where('user_id', $userId)->first()
            );

            if (!empty($attendance)) {
                if (empty($attendance['waktu_keluar'])) {
                    $data = [
                        'message' =>
                            'anda sudah absen masuk, harap tunggu absen keluar',
                    ];
                    return response()->json($data, 503);
                } else {
                    $data = [
                        'message' =>
                            'Anda sudah menyelesaikan pekerjaan hari ini',
                    ];
                    return response()->json($data, 503);
                }
            } else {
                if ($this->cekL($latitude, $longitude)) {

                    $evidenceFile = $request->file('evidence');
                    $fileName = $userId . '_' . time() . '.' . $evidenceFile->getClientOriginalExtension();
            
                    // Dapatkan format bulan dan tahun saat ini (contoh: September2023)
                    $currentMonthYear = Carbon::now()->format('FY');
            
                    // Simpan gambar ke direktori yang sesuai
                    $evidenceFile->storeAs('public/attendances/' . $currentMonthYear, $fileName);
            
                    Attendance::create([
                        'user_id' => $userId,
                        'waktu_masuk' => Carbon::now()->format('H:i:s'),
                        'lokasi_masuk' => $lokasi,
                        'tanggal' => $currentDate,
                        'device' => $namaDevice,
                        'evidence' => 'attendances/' . $currentMonthYear . '/' . $fileName,
                    ]);
                    $attendance = Attendance::where('user_id', $userId)
                        ->whereDate('tanggal', $currentDate)
                        ->latest()
                        ->first();
                    $attendanceData = new AttandanceResource($attendance);
    
                    $data = [
                        'message' => 'berhasil absen masuk',
                        'data' => $attendanceData,
                    ];
                    return response()->json($data, 200);
                } else {
                    return response()->json(['message' => 'Tidak di dalam area kantor'], 503);
                }
                
            }
        }
    }

    public function getCurrentAttandace(string $id)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('user_id', $id)
            ->whereDate('tanggal', $currentDate)
            ->first();

        if (!$attendance) {
            $data = [
                'data' => null,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'data' => $attendance,
        ];
        return response()->json($data, 200);
    }

    public function absenKeluar(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $lokasi = $request->input('lokasi_keluar');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $namaDevice = $request->input('device');
        
        $validator = Validator::make(
            $request->all(),
            [
                'lokasi_keluar' => 'required',
                'device' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ],
            [
                'lokasi_keluar.required' => 'Lokasi harus diisi.',
                'device.required' => 'Nama device harus di isi.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = ['message' => $errors, 'status' => false];
            return response()->json($data, 503);
        } else {

            $currentDate = Carbon::now()->format('Y-m-d');
            $attendance = Attendance::where('user_id', $userId)
                ->whereDate('tanggal', $currentDate)
                ->first();
            $absenSchedule = collect(
                Schedule::where('user_id', $userId)->first()
            );

            if ($this->cekL($latitude, $longitude)) {


            if (!empty($attendance)) {
                if (empty($attendance['waktu_keluar'])) {
                    if (
                        Carbon::now() >=
                        Carbon::parse($absenSchedule['jam_keluar'])
                    ) {
                        if ($attendance['device'] == $namaDevice) {
                            if ($this->cekL($latitude, $longitude)) {       
                                $waktuMasuk = Carbon::parse($attendance['waktu_masuk']);
                                $waktuSekarang = Carbon::parse(Carbon::now());
                                $lamaWaktu = $waktuMasuk->diff($waktuSekarang);
                                $waktuKerja = $lamaWaktu->format('%h:%i:%s');
                                Attendance::where('user_id', $userId)->update([
                                    'waktu_keluar' => Carbon::now()->format('H:i:s'),
                                    'lokasi_keluar' => $lokasi,
                                    'waktu_kerja' => $waktuKerja,
                                    'device' => $namaDevice
                                ]);
                                $attendance = Attendance::where('user_id', $userId)
                                    ->whereDate('tanggal', $currentDate)
                                    ->first();
                                $message = [
                                    'message' => 'Berhasil absen Keluar',
                                    'status' => 200,
                                ];
                                return response()->json($message, 200);
                            } else {
                                return response()->json(['message' => 'Tidak di dalam area kantor'], 503);
                            }
                        }else{
                            return response()->json(['message' => 'Harus menggunakan device yang sama saat check in'], 503);
                        }
                        

                    } else {
                        $attendance = Attendance::where('user_id', $userId)
                            ->whereDate('tanggal', $currentDate)
                            ->first();

                        $message = [
                            'message' =>
                                'anda sudah absen masuk & belum saatnya absen keluar',
                        ];

                        return response()->json($message, 503);
                    }
                } else {
                    $data = [
                        'message' =>
                            'Anda sudah menyelesaikan pekerjaan hari ini',
                    ];
                    return response()->json($data, 503);
                }
            } else {
                $data = [
                    'status' => false,
                    'message' =>
                        'Anda belum login silahkan login terlebih dahulu',
                ];
                return response()->json($data, 503);
            }
        } else {
            return response()->json(['message' => 'Tidak di dalam area kantor'], 503);
        }

        }
    }


    public function current(){
        $today = date('Y-m-d');
        $token = request()->header('Authorization');
        $user = Auth::user($token);
        $attendance = Attendance::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        // Jika ada data kehadiran, maka user sudah absen
        if ($attendance) {
            // Kembalikan data kehadiran
            $attendanceData = new AttandanceResource($attendance);
            return response()->json(["data" => $attendanceData], 200);
        } else {
            //data kosong => belum absen
            return response()->json(["data" => null], 200);
        }
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:attendances,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 404);
        }

        $id_absen = $request->input('id');
        Attendance::where('id', $id_absen)->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function cekL($latitude,$longitude)
    {
        $today = date('Y-m-d');
        $userLatitude = $latitude;
        $userLongitude = $longitude;
        $yourLatitude = 0.9978969; // Gantilah dengan koordinat yang Anda miliki
        $yourLongitude = 102.7268471; // Gantilah dengan koordinat yang Anda miliki
        // Hitung jarak menggunakan rumus Haversine
        $distance = $this->haversineDistance($userLatitude, $userLongitude, $yourLatitude, $yourLongitude);
        // Tentukan batas jarak
        $distanceThreshold = 100000; // Gantilah dengan batas jarak yang Anda inginkan (dalam kilometer)
        if ($distance <= $distanceThreshold) {
            return true;
        } else {
            return false;
        } 
    }
    public function compareLocation(Request $request)
    {
        $today = date('Y-m-d');
        $userLatitude = request()->query('latitude');
        $userLongitude = request()->query('longitude');
        $yourLatitude = 0.9978969; // Gantilah dengan koordinat yang Anda miliki
        $yourLongitude = 102.7268471; // Gantilah dengan koordinat yang Anda miliki
        // Hitung jarak menggunakan rumus Haversine
        $distance = $this->haversineDistance($userLatitude, $userLongitude, $yourLatitude, $yourLongitude);
        // Tentukan batas jarak
        $distanceThreshold = 100000; // Gantilah dengan batas jarak yang Anda inginkan (dalam kilometer)
        if ($distance <= $distanceThreshold) {
            return response()->json(['message' => 'Jarak aman.']);
        } else {
            return response()->json(['data' => null],200);
        } 
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam kilometer
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return $distance;
    }
}
 // public function delete(Request $request){
    //     $user = auth()->user();
    //     $userId = $user->id; 
    //     $id_absen = $request->input('id');           
    //     return response()->json($id_absen, 200);
    // }