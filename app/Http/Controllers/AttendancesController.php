<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AttendancesController extends Controller
{
    public function absenMasuk(Request $request)
    {
        $lokasi = $request->input('lokasi_masuk');
        $userId = $request->input('user_id');

        $validator = Validator::make(
            $request->all(),
            [
                'lokasi_masuk' => 'required',
                'user_id' => 'required',
            ],
            [
                'user_id.required' => 'User id harus diisi.',
                'lokasi_masuk.required' => 'Lokasi harus diisi.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = ['message' => $errors, 'status' => false];
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
                        'status' => false,
                        'message' =>
                            'anda sudah absen masuk, harap tunggu absen keluar',
                    ];
                    return response()->json($data, 409);
                } else {
                    $data = [
                        'status' => false,
                        'message' =>
                            'Anda sudah menyelesaikan pekerjaan hari ini',
                    ];
                    return response()->json($data, 409);
                }
            } else {
                Attendance::create([
                    'user_id' => $userId,
                    'waktu_masuk' => Carbon::now()->format('H:i:s'),
                    'lokasi_masuk' => $lokasi,
                    'tanggal' => $currentDate,
                ]);
                $attendance = Attendance::where('user_id', $userId)
                    ->whereDate('tanggal', $currentDate)
                    ->latest()
                    ->first();

                $data = [
                    'message' => 'berhasil absen masuk',
                    'data' => $attendance,
                    'status' => 201,
                ];
                return response()->json($data, 201);
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
                'status' => false,
                'message' => 'Data kosong',
            ];
            return response()->json($data, 409);
        }

        $data = [
            'status' => true,
            'message' => 'Get Data Attandace',
            'data' => $attendance,
        ];
        return response()->json($data, 200);
    }

    public function absenKeluar(Request $request)
    {
        $lokasi = $request->input('lokasi_keluar');
        $userId = $request->input('user_id');

        $validator = Validator::make(
            $request->all(),
            [
                'lokasi_keluar' => 'required',
                'user_id' => 'required',
            ],
            [
                'user_id.required' => 'User id harus diisi.',
                'lokasi_keluar.required' => 'Lokasi harus diisi.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = ['message' => $errors, 'status' => false];
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
                    if (
                        Carbon::now() >=
                        Carbon::parse($absenSchedule['jam_keluar'])
                    ) {
                        $waktuMasuk = Carbon::parse($attendance['waktu_masuk']);
                        $waktuSekarang = Carbon::parse(Carbon::now());

                        $lamaWaktu = $waktuMasuk->diff($waktuSekarang);
                        $waktuKerja = $lamaWaktu->format('%h:%i:%s');
                        Attendance::where('user_id', $userId)->update([
                            'waktu_keluar' => Carbon::now()->format('H:i:s'),
                            'lokasi_keluar' => $lokasi,
                            'waktu_kerja' => $waktuKerja,
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
                        $attendance = Attendance::where('user_id', $userId)
                            ->whereDate('tanggal', $currentDate)
                            ->first();

                        $message = [
                            'status' => false,
                            'message' =>
                                'anda sudah absen masuk & belum saatnya absen keluar',
                        ];

                        return response()->json($message, 409);
                    }
                } else {
                    $data = [
                        'status' => false,
                        'message' =>
                            'Anda sudah menyelesaikan pekerjaan hari ini',
                    ];
                    return response()->json($data, 409);
                }
            } else {
                $data = [
                    'status' => false,
                    'message' =>
                        'Anda belum login silahkan login terlebih dahulu',
                ];
                return response()->json($data, 409);
            }
        }
    }


    public function compareLocation(Request $request)
    {
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
            return response()->json(['message' => 'Jarak terlalu jauh.']);
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
