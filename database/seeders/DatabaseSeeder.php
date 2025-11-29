<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo Admin
        $admin = User::create([
            'name' => 'Quản trị viên',
            'email' => 'admin@hospital.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0901234567',
            'address' => '123 Đường ABC, Quận 1, TP.HCM',
            'status' => 'active',
        ]);

        // Tạo Bác sĩ
        $doctors = [
            [
                'name' => 'BS. Nguyễn Văn An',
                'email' => 'doctor1@hospital.com',
                'phone' => '0901111111',
                'address' => '456 Đường XYZ, Quận 2, TP.HCM',
                'avatar' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop',
                'specialization' => 'Tim mạch',
                'experience' => 15,
                'qualification' => 'Tiến sĩ Y khoa',
                'bio' => 'Bác sĩ chuyên khoa Tim mạch với hơn 15 năm kinh nghiệm. Chuyên điều trị các bệnh lý về tim mạch, huyết áp cao, suy tim.',
                'consultation_fee' => 500000,
            ],
            [
                'name' => 'BS. Trần Thị Bình',
                'email' => 'doctor2@hospital.com',
                'phone' => '0902222222',
                'address' => '789 Đường DEF, Quận 3, TP.HCM',
                'avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop',
                'specialization' => 'Nhi khoa',
                'experience' => 12,
                'qualification' => 'Thạc sĩ Y khoa',
                'bio' => 'Bác sĩ Nhi khoa giàu kinh nghiệm, chuyên điều trị các bệnh lý ở trẻ em, tư vấn dinh dưỡng và phát triển trẻ em.',
                'consultation_fee' => 400000,
            ],
            [
                'name' => 'BS. Lê Văn Cường',
                'email' => 'doctor3@hospital.com',
                'phone' => '0903333333',
                'address' => '321 Đường GHI, Quận 4, TP.HCM',
                'avatar' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop',
                'specialization' => 'Nội tiết',
                'experience' => 10,
                'qualification' => 'Thạc sĩ Y khoa',
                'bio' => 'Chuyên gia về Nội tiết, điều trị bệnh tiểu đường, rối loạn hormone, bệnh tuyến giáp.',
                'consultation_fee' => 450000,
            ],
            [
                'name' => 'BS. Phạm Thị Dung',
                'email' => 'doctor4@hospital.com',
                'phone' => '0904444444',
                'address' => '654 Đường JKL, Quận 5, TP.HCM',
                'avatar' => 'https://images.unsplash.com/photo-1594824476968-48dfc9d1263c?w=400&h=400&fit=crop',
                'specialization' => 'Da liễu',
                'experience' => 8,
                'qualification' => 'Bác sĩ Y khoa',
                'bio' => 'Bác sĩ Da liễu chuyên điều trị các bệnh về da, tư vấn chăm sóc da và thẩm mỹ da.',
                'consultation_fee' => 350000,
            ],
        ];

        foreach ($doctors as $doctorData) {
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $doctorData['email'],
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => $doctorData['phone'],
                'address' => $doctorData['address'],
                'status' => 'active',
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'avatar' => $doctorData['avatar'] ?? null,
                'specialization' => $doctorData['specialization'],
                'experience' => $doctorData['experience'],
                'qualification' => $doctorData['qualification'],
                'bio' => $doctorData['bio'],
                'consultation_fee' => $doctorData['consultation_fee'],
            ]);
        }

        // Tạo Tiếp viên
        $receptionists = [
            [
                'name' => 'Nguyễn Thị Lan',
                'email' => 'receptionist1@hospital.com',
                'phone' => '0905555555',
                'address' => '987 Đường MNO, Quận 6, TP.HCM',
                'shift' => 'Sáng (7h-12h)',
            ],
            [
                'name' => 'Trần Văn Minh',
                'email' => 'receptionist2@hospital.com',
                'phone' => '0906666666',
                'address' => '147 Đường PQR, Quận 7, TP.HCM',
                'shift' => 'Chiều (13h-18h)',
            ],
        ];

        foreach ($receptionists as $receptionistData) {
            $user = User::create([
                'name' => $receptionistData['name'],
                'email' => $receptionistData['email'],
                'password' => Hash::make('password'),
                'role' => 'receptionist',
                'phone' => $receptionistData['phone'],
                'address' => $receptionistData['address'],
                'status' => 'active',
            ]);

            Receptionist::create([
                'user_id' => $user->id,
                'shift' => $receptionistData['shift'],
            ]);
        }

        // Tạo Bệnh nhân mẫu
        $patients = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'patient1@example.com',
                'phone' => '0907777777',
                'date_of_birth' => '1990-01-15',
                'gender' => 'male',
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'patient2@example.com',
                'phone' => '0908888888',
                'date_of_birth' => '1985-05-20',
                'gender' => 'female',
            ],
        ];

        foreach ($patients as $patientData) {
            $user = User::create([
                'name' => $patientData['name'],
                'email' => $patientData['email'],
                'password' => Hash::make('password'),
                'role' => 'patient',
                'phone' => $patientData['phone'],
                'status' => 'active',
            ]);

            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $patientData['date_of_birth'],
                'gender' => $patientData['gender'],
            ]);
        }

        // Tạo Dịch vụ
        $services = [
            [
                'name' => 'Khám tổng quát',
                'description' => 'Khám sức khỏe tổng quát, kiểm tra các chỉ số cơ bản, tư vấn sức khỏe.',
                'price' => 200000,
                'duration' => 30,
                'status' => 'active',
            ],
            [
                'name' => 'Khám tim mạch',
                'description' => 'Khám chuyên khoa tim mạch, đo điện tim, siêu âm tim, tư vấn điều trị.',
                'price' => 500000,
                'duration' => 45,
                'status' => 'active',
            ],
            [
                'name' => 'Khám nhi khoa',
                'description' => 'Khám sức khỏe trẻ em, tư vấn dinh dưỡng, tiêm chủng, phát triển trẻ em.',
                'price' => 400000,
                'duration' => 30,
                'status' => 'active',
            ],
            [
                'name' => 'Khám nội tiết',
                'description' => 'Khám và điều trị các bệnh lý nội tiết, tiểu đường, rối loạn hormone.',
                'price' => 450000,
                'duration' => 40,
                'status' => 'active',
            ],
            [
                'name' => 'Khám da liễu',
                'description' => 'Khám và điều trị các bệnh về da, tư vấn chăm sóc da, thẩm mỹ da.',
                'price' => 350000,
                'duration' => 25,
                'status' => 'active',
            ],
            [
                'name' => 'Xét nghiệm máu',
                'description' => 'Xét nghiệm máu tổng quát, kiểm tra các chỉ số sinh hóa, huyết học.',
                'price' => 300000,
                'duration' => 15,
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Tạo Bài viết
        $this->call(PostSeeder::class);

        $this->command->info('Đã tạo dữ liệu mẫu thành công!');
        $this->command->info('Admin: admin@hospital.com / password');
        $this->command->info('Bác sĩ: doctor1@hospital.com / password');
        $this->command->info('Tiếp viên: receptionist1@hospital.com / password');
        $this->command->info('Bệnh nhân: patient1@example.com / password');
    }
}
