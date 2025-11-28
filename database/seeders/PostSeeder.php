<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $this->command->warn('Không tìm thấy admin, vui lòng chạy DatabaseSeeder trước.');
            return;
        }

        $posts = [
            [
                'title' => '10 cách phòng ngừa bệnh tim mạch hiệu quả',
                'content' => '<h2>Bệnh tim mạch là một trong những nguyên nhân gây tử vong hàng đầu</h2>
                <p>Dưới đây là 10 cách phòng ngừa hiệu quả để bảo vệ sức khỏe tim mạch của bạn:</p>
                <ol>
                    <li><strong>Duy trì chế độ ăn uống lành mạnh:</strong> Ăn nhiều rau xanh, trái cây, ngũ cốc nguyên hạt, hạn chế chất béo bão hòa và muối.</li>
                    <li><strong>Tập thể dục thường xuyên:</strong> Ít nhất 30 phút mỗi ngày, 5 ngày/tuần giúp cải thiện sức khỏe tim mạch.</li>
                    <li><strong>Kiểm soát cân nặng:</strong> Duy trì chỉ số BMI trong khoảng 18.5-24.9.</li>
                    <li><strong>Bỏ thuốc lá:</strong> Hút thuốc là nguyên nhân chính gây bệnh tim mạch.</li>
                    <li><strong>Hạn chế rượu bia:</strong> Không quá 1-2 ly/ngày đối với nam, 1 ly/ngày đối với nữ.</li>
                    <li><strong>Quản lý căng thẳng:</strong> Thực hành yoga, thiền định, hoặc các hoạt động thư giãn.</li>
                    <li><strong>Kiểm tra sức khỏe định kỳ:</strong> Đo huyết áp, cholesterol, đường huyết ít nhất 1 lần/năm.</li>
                    <li><strong>Kiểm soát huyết áp:</strong> Duy trì huyết áp dưới 120/80 mmHg.</li>
                    <li><strong>Kiểm soát cholesterol:</strong> Giữ mức cholesterol toàn phần dưới 200 mg/dL.</li>
                    <li><strong>Ngủ đủ giấc:</strong> Ngủ 7-9 giờ mỗi đêm để tim được nghỉ ngơi đầy đủ.</li>
                </ol>
                <p><strong>Hãy thực hiện các biện pháp trên để bảo vệ sức khỏe tim mạch của bạn!</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Dinh dưỡng cho trẻ em phát triển toàn diện',
                'content' => '<h2>Dinh dưỡng đóng vai trò quan trọng trong sự phát triển của trẻ em</h2>
                <p>Các bậc phụ huynh cần chú ý những điểm sau:</p>
                <ul>
                    <li><strong>Cung cấp đầy đủ các nhóm chất:</strong> Đạm, béo, đường, vitamin và khoáng chất là nền tảng cho sự phát triển.</li>
                    <li><strong>Cho trẻ ăn đa dạng các loại thực phẩm:</strong> Mỗi loại thực phẩm cung cấp các chất dinh dưỡng khác nhau.</li>
                    <li><strong>Hạn chế đồ ngọt và thức ăn nhanh:</strong> Những thực phẩm này chứa nhiều đường, muối và chất béo không tốt.</li>
                    <li><strong>Khuyến khích trẻ uống đủ nước:</strong> Nước giúp trao đổi chất và duy trì sức khỏe tốt.</li>
                    <li><strong>Tạo thói quen ăn uống đúng giờ:</strong> Ăn đúng bữa giúp hệ tiêu hóa hoạt động hiệu quả.</li>
                </ul>
                <p><strong>Hãy tham khảo ý kiến bác sĩ dinh dưỡng để có chế độ ăn phù hợp cho con bạn.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Những dấu hiệu cảnh báo bệnh tiểu đường',
                'content' => '<h2>Bệnh tiểu đường có thể được phát hiện sớm thông qua các dấu hiệu sau</h2>
                <p>Nếu bạn gặp các triệu chứng dưới đây, hãy đến khám bác sĩ ngay:</p>
                <ul>
                    <li><strong>Khát nước và đi tiểu nhiều:</strong> Cơ thể cố gắng loại bỏ lượng đường dư thừa qua nước tiểu.</li>
                    <li><strong>Mệt mỏi không rõ nguyên nhân:</strong> Thiếu insulin khiến cơ thể không thể sử dụng glucose hiệu quả.</li>
                    <li><strong>Sụt cân đột ngột:</strong> Cơ thể đốt cháy chất béo và cơ để lấy năng lượng.</li>
                    <li><strong>Vết thương lâu lành:</strong> Đường huyết cao làm suy giảm khả năng miễn dịch.</li>
                    <li><strong>Mờ mắt:</strong> Đường huyết cao ảnh hưởng đến thủy tinh thể.</li>
                    <li><strong>Tê bì chân tay:</strong> Tổn thương thần kinh do đường huyết cao kéo dài.</li>
                </ul>
                <p><strong>Nếu bạn có các dấu hiệu trên, hãy đến khám bác sĩ để được chẩn đoán và điều trị kịp thời.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Cách phòng ngừa cảm cúm mùa hiệu quả',
                'content' => '<h2>Mùa cảm cúm đang đến, hãy bảo vệ bản thân và gia đình</h2>
                <p>Dưới đây là những cách phòng ngừa cảm cúm hiệu quả:</p>
                <ol>
                    <li><strong>Tiêm phòng vắc-xin cúm:</strong> Tiêm phòng hàng năm là cách tốt nhất để phòng ngừa cúm.</li>
                    <li><strong>Rửa tay thường xuyên:</strong> Rửa tay bằng xà phòng hoặc dung dịch sát khuẩn ít nhất 20 giây.</li>
                    <li><strong>Tránh tiếp xúc gần với người bệnh:</strong> Giữ khoảng cách ít nhất 1 mét.</li>
                    <li><strong>Đeo khẩu trang:</strong> Đặc biệt khi ở nơi đông người hoặc khi có triệu chứng.</li>
                    <li><strong>Tăng cường sức đề kháng:</strong> Ăn uống đầy đủ, ngủ đủ giấc, tập thể dục thường xuyên.</li>
                    <li><strong>Giữ môi trường sạch sẽ:</strong> Vệ sinh nhà cửa, thông gió phòng ốc thường xuyên.</li>
                </ol>
                <p><strong>Nếu có triệu chứng cảm cúm, hãy nghỉ ngơi tại nhà và liên hệ bác sĩ khi cần thiết.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Tầm quan trọng của việc khám sức khỏe định kỳ',
                'content' => '<h2>Khám sức khỏe định kỳ giúp phát hiện sớm các vấn đề sức khỏe</h2>
                <p>Việc khám sức khỏe định kỳ mang lại nhiều lợi ích:</p>
                <ul>
                    <li><strong>Phát hiện sớm bệnh tật:</strong> Nhiều bệnh có thể được điều trị hiệu quả nếu phát hiện sớm.</li>
                    <li><strong>Ngăn ngừa biến chứng:</strong> Kiểm soát các chỉ số sức khỏe giúp tránh biến chứng nguy hiểm.</li>
                    <li><strong>Tiết kiệm chi phí:</strong> Điều trị sớm thường ít tốn kém hơn điều trị khi bệnh đã nặng.</li>
                    <li><strong>Yên tâm về sức khỏe:</strong> Biết rõ tình trạng sức khỏe giúp bạn yên tâm hơn.</li>
                    <li><strong>Tư vấn chế độ sống:</strong> Bác sĩ sẽ tư vấn chế độ ăn uống, tập luyện phù hợp.</li>
                </ul>
                <p><strong>Khuyến nghị:</strong> Người trưởng thành nên khám sức khỏe tổng quát ít nhất 1 lần/năm. Người trên 40 tuổi nên khám 2 lần/năm.</p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Chế độ ăn uống lành mạnh cho người cao tuổi',
                'content' => '<h2>Dinh dưỡng phù hợp giúp người cao tuổi duy trì sức khỏe tốt</h2>
                <p>Người cao tuổi cần chú ý những điểm sau trong chế độ ăn uống:</p>
                <ol>
                    <li><strong>Ăn đủ đạm:</strong> Cần 1-1.2g đạm/kg cân nặng/ngày để duy trì cơ bắp.</li>
                    <li><strong>Bổ sung canxi và vitamin D:</strong> Ngăn ngừa loãng xương, cần 1000-1200mg canxi/ngày.</li>
                    <li><strong>Ăn nhiều chất xơ:</strong> Giúp tiêu hóa tốt, ngăn ngừa táo bón.</li>
                    <li><strong>Uống đủ nước:</strong> Ít nhất 1.5-2 lít nước/ngày, tránh mất nước.</li>
                    <li><strong>Hạn chế muối:</strong> Không quá 5g muối/ngày để tránh tăng huyết áp.</li>
                    <li><strong>Chia nhỏ bữa ăn:</strong> Ăn 5-6 bữa nhỏ thay vì 3 bữa lớn giúp tiêu hóa tốt hơn.</li>
                </ol>
                <p><strong>Hãy tham khảo ý kiến bác sĩ dinh dưỡng để có chế độ ăn phù hợp với tình trạng sức khỏe của bạn.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Cách chăm sóc da mùa hanh khô',
                'content' => '<h2>Mùa hanh khô khiến da dễ bị khô, nứt nẻ</h2>
                <p>Dưới đây là những cách chăm sóc da hiệu quả trong mùa hanh khô:</p>
                <ul>
                    <li><strong>Dưỡng ẩm thường xuyên:</strong> Thoa kem dưỡng ẩm ngay sau khi tắm, khi da còn ẩm.</li>
                    <li><strong>Uống đủ nước:</strong> Uống ít nhất 2 lít nước/ngày để giữ ẩm từ bên trong.</li>
                    <li><strong>Tắm nước ấm, không quá nóng:</strong> Nước quá nóng làm mất độ ẩm tự nhiên của da.</li>
                    <li><strong>Sử dụng sữa tắm dịu nhẹ:</strong> Tránh các sản phẩm có chứa cồn hoặc chất tẩy mạnh.</li>
                    <li><strong>Bảo vệ da khỏi gió:</strong> Đeo khẩu trang, mặc quần áo che kín khi ra ngoài.</li>
                    <li><strong>Bổ sung omega-3:</strong> Ăn cá, hạt óc chó, hạt lanh để cải thiện độ ẩm da.</li>
                </ul>
                <p><strong>Nếu da có dấu hiệu viêm, ngứa nghiêm trọng, hãy đến khám bác sĩ da liễu.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Tập thể dục đúng cách cho người mới bắt đầu',
                'content' => '<h2>Tập thể dục mang lại nhiều lợi ích cho sức khỏe</h2>
                <p>Nếu bạn mới bắt đầu tập thể dục, hãy lưu ý:</p>
                <ol>
                    <li><strong>Bắt đầu từ từ:</strong> Bắt đầu với 10-15 phút/ngày, tăng dần theo thời gian.</li>
                    <li><strong>Chọn bài tập phù hợp:</strong> Đi bộ, đạp xe, bơi lội là những bài tập nhẹ nhàng phù hợp cho người mới.</li>
                    <li><strong>Khởi động trước khi tập:</strong> 5-10 phút khởi động giúp giảm nguy cơ chấn thương.</li>
                    <li><strong>Giãn cơ sau khi tập:</strong> Giúp cơ bắp phục hồi nhanh hơn.</li>
                    <li><strong>Uống đủ nước:</strong> Uống nước trước, trong và sau khi tập.</li>
                    <li><strong>Nghỉ ngơi đầy đủ:</strong> Cơ thể cần thời gian để phục hồi giữa các buổi tập.</li>
                </ol>
                <p><strong>Mục tiêu:</strong> Tập thể dục ít nhất 150 phút/tuần với cường độ vừa phải hoặc 75 phút/tuần với cường độ cao.</p>
                <p><strong>Lưu ý:</strong> Nếu có bệnh lý mãn tính, hãy tham khảo ý kiến bác sĩ trước khi bắt đầu.</p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Dấu hiệu và cách xử lý khi bị sốt',
                'content' => '<h2>Sốt là phản ứng tự nhiên của cơ thể khi chống lại nhiễm trùng</h2>
                <p><strong>Dấu hiệu sốt:</strong></p>
                <ul>
                    <li>Nhiệt độ cơ thể trên 37.5°C (đo ở nách) hoặc 38°C (đo ở miệng)</li>
                    <li>Ớn lạnh, run rẩy</li>
                    <li>Đau đầu, mệt mỏi</li>
                    <li>Đổ mồ hôi</li>
                    <li>Mất nước</li>
                </ul>
                <p><strong>Cách xử lý:</strong></p>
                <ol>
                    <li><strong>Nghỉ ngơi:</strong> Nghỉ ngơi đầy đủ giúp cơ thể phục hồi.</li>
                    <li><strong>Uống nhiều nước:</strong> Bù nước và điện giải, có thể uống oresol.</li>
                    <li><strong>Mặc quần áo thoáng mát:</strong> Không đắp chăn quá dày.</li>
                    <li><strong>Chườm mát:</strong> Chườm khăn ẩm lên trán, nách, bẹn.</li>
                    <li><strong>Dùng thuốc hạ sốt:</strong> Paracetamol hoặc ibuprofen theo chỉ dẫn.</li>
                </ol>
                <p><strong>Khi nào cần đến bác sĩ:</strong></p>
                <ul>
                    <li>Sốt trên 39°C kéo dài hơn 3 ngày</li>
                    <li>Sốt kèm theo co giật, khó thở, đau ngực</li>
                    <li>Trẻ em dưới 3 tháng tuổi bị sốt</li>
                    <li>Sốt sau khi đi du lịch vùng nhiệt đới</li>
                </ul>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Phòng ngừa bệnh loãng xương',
                'content' => '<h2>Loãng xương là bệnh phổ biến ở người cao tuổi, đặc biệt là phụ nữ</h2>
                <p><strong>Nguyên nhân:</strong></p>
                <ul>
                    <li>Thiếu canxi và vitamin D</li>
                    <li>Ít vận động</li>
                    <li>Hút thuốc, uống rượu</li>
                    <li>Thiếu hormone estrogen (ở phụ nữ mãn kinh)</li>
                    <li>Di truyền</li>
                </ul>
                <p><strong>Cách phòng ngừa:</strong></p>
                <ol>
                    <li><strong>Bổ sung đủ canxi:</strong> 1000-1200mg/ngày từ sữa, cá, rau xanh.</li>
                    <li><strong>Bổ sung vitamin D:</strong> Tắm nắng 15-20 phút/ngày hoặc uống bổ sung.</li>
                    <li><strong>Tập thể dục thường xuyên:</strong> Đi bộ, chạy bộ, tập tạ giúp tăng mật độ xương.</li>
                    <li><strong>Tránh hút thuốc và rượu:</strong> Cả hai đều làm giảm mật độ xương.</li>
                    <li><strong>Kiểm tra mật độ xương:</strong> Phụ nữ trên 65 tuổi nên kiểm tra định kỳ.</li>
                </ol>
                <p><strong>Triệu chứng:</strong> Đau lưng, gù lưng, dễ gãy xương. Nếu có các dấu hiệu trên, hãy đến khám bác sĩ.</p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Cách bảo vệ mắt khi làm việc với máy tính',
                'content' => '<h2>Làm việc với máy tính nhiều giờ có thể gây mỏi mắt, khô mắt</h2>
                <p><strong>Triệu chứng mỏi mắt do máy tính:</strong></p>
                <ul>
                    <li>Mắt khô, đỏ, ngứa</li>
                    <li>Mờ mắt, nhìn đôi</li>
                    <li>Đau đầu, đau cổ</li>
                    <li>Nhạy cảm với ánh sáng</li>
                </ul>
                <p><strong>Cách bảo vệ mắt:</strong></p>
                <ol>
                    <li><strong>Quy tắc 20-20-20:</strong> Cứ 20 phút, nhìn xa 20 feet (6m) trong 20 giây.</li>
                    <li><strong>Điều chỉnh màn hình:</strong> Độ sáng vừa phải, độ tương phản phù hợp.</li>
                    <li><strong>Khoảng cách phù hợp:</strong> Màn hình cách mắt 50-70cm, tâm màn hình thấp hơn mắt 10-20cm.</li>
                    <li><strong>Ánh sáng đầy đủ:</strong> Tránh làm việc trong phòng tối, có đèn bàn phụ.</li>
                    <li><strong>Chớp mắt thường xuyên:</strong> Chớp mắt giúp giữ ẩm cho mắt.</li>
                    <li><strong>Dùng nước mắt nhân tạo:</strong> Nếu mắt khô, có thể nhỏ nước mắt nhân tạo.</li>
                    <li><strong>Đeo kính chống ánh sáng xanh:</strong> Giảm tác hại của ánh sáng xanh từ màn hình.</li>
                </ol>
                <p><strong>Khám mắt định kỳ:</strong> Nên khám mắt 1-2 lần/năm, đặc biệt nếu có triệu chứng bất thường.</p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Dinh dưỡng cho phụ nữ mang thai',
                'content' => '<h2>Dinh dưỡng đúng cách giúp mẹ và bé khỏe mạnh</h2>
                <p><strong>Những chất dinh dưỡng quan trọng:</strong></p>
                <ul>
                    <li><strong>Axit folic:</strong> 400-800mcg/ngày, ngăn ngừa dị tật ống thần kinh. Có trong rau xanh, đậu, ngũ cốc.</li>
                    <li><strong>Sắt:</strong> 27mg/ngày, ngăn ngừa thiếu máu. Có trong thịt đỏ, rau xanh, đậu.</li>
                    <li><strong>Canxi:</strong> 1000-1300mg/ngày, phát triển xương và răng. Có trong sữa, cá, rau xanh.</li>
                    <li><strong>Protein:</strong> 70-100g/ngày, phát triển tế bào. Có trong thịt, cá, trứng, đậu.</li>
                    <li><strong>Omega-3:</strong> Phát triển não bộ. Có trong cá hồi, cá thu, hạt óc chó.</li>
                </ul>
                <p><strong>Thực phẩm nên tránh:</strong></p>
                <ul>
                    <li>Rượu, bia, thuốc lá</li>
                    <li>Cá có hàm lượng thủy ngân cao (cá mập, cá kiếm)</li>
                    <li>Thực phẩm sống, chưa nấu chín</li>
                    <li>Caffeine quá nhiều (không quá 200mg/ngày)</li>
                </ul>
                <p><strong>Lưu ý:</strong> Tăng cân hợp lý: 11-16kg cho người bình thường, 7-11kg cho người thừa cân.</p>
                <p><strong>Hãy tham khảo ý kiến bác sĩ để có chế độ dinh dưỡng phù hợp với tình trạng sức khỏe của bạn.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Cách phòng ngừa bệnh gan nhiễm mỡ',
                'content' => '<h2>Gan nhiễm mỡ là tình trạng tích tụ mỡ trong gan</h2>
                <p><strong>Nguyên nhân:</strong></p>
                <ul>
                    <li>Béo phì, thừa cân</li>
                    <li>Tiểu đường type 2</li>
                    <li>Rối loạn lipid máu</li>
                    <li>Uống nhiều rượu bia</li>
                    <li>Lối sống ít vận động</li>
                </ul>
                <p><strong>Cách phòng ngừa:</strong></p>
                <ol>
                    <li><strong>Giảm cân:</strong> Giảm 5-10% trọng lượng cơ thể giúp cải thiện đáng kể.</li>
                    <li><strong>Chế độ ăn lành mạnh:</strong> Ăn nhiều rau xanh, trái cây, hạn chế đường và chất béo.</li>
                    <li><strong>Tập thể dục:</strong> Ít nhất 30 phút/ngày, 5 ngày/tuần.</li>
                    <li><strong>Hạn chế rượu bia:</strong> Nam không quá 2 ly/ngày, nữ không quá 1 ly/ngày.</li>
                    <li><strong>Kiểm soát đường huyết:</strong> Nếu bị tiểu đường, cần kiểm soát tốt.</li>
                    <li><strong>Kiểm tra định kỳ:</strong> Siêu âm gan, xét nghiệm chức năng gan 1-2 lần/năm.</li>
                </ol>
                <p><strong>Triệu chứng:</strong> Thường không có triệu chứng rõ ràng. Một số người có thể cảm thấy mệt mỏi, đau bụng nhẹ.</p>
                <p><strong>Nếu được chẩn đoán gan nhiễm mỡ, hãy tuân thủ điều trị và thay đổi lối sống theo hướng dẫn của bác sĩ.</strong></p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Tầm quan trọng của giấc ngủ đối với sức khỏe',
                'content' => '<h2>Giấc ngủ đóng vai trò quan trọng trong việc duy trì sức khỏe</h2>
                <p><strong>Lợi ích của giấc ngủ đủ:</strong></p>
                <ul>
                    <li><strong>Phục hồi cơ thể:</strong> Cơ thể tự sửa chữa và tái tạo tế bào trong khi ngủ.</li>
                    <li><strong>Tăng cường trí nhớ:</strong> Giấc ngủ giúp củng cố và lưu trữ thông tin.</li>
                    <li><strong>Tăng cường miễn dịch:</strong> Ngủ đủ giấc giúp hệ miễn dịch hoạt động tốt hơn.</li>
                    <li><strong>Kiểm soát cân nặng:</strong> Thiếu ngủ làm tăng cảm giác thèm ăn.</li>
                    <li><strong>Cải thiện tâm trạng:</strong> Ngủ đủ giấc giúp tinh thần sảng khoái, giảm căng thẳng.</li>
                </ul>
                <p><strong>Thời gian ngủ khuyến nghị:</strong></p>
                <ul>
                    <li>Trẻ sơ sinh (0-3 tháng): 14-17 giờ/ngày</li>
                    <li>Trẻ em (3-5 tuổi): 10-13 giờ/ngày</li>
                    <li>Thanh thiếu niên (14-17 tuổi): 8-10 giờ/ngày</li>
                    <li>Người trưởng thành (18-64 tuổi): 7-9 giờ/ngày</li>
                    <li>Người cao tuổi (65+): 7-8 giờ/ngày</li>
                </ul>
                <p><strong>Mẹo để ngủ ngon:</strong></p>
                <ol>
                    <li>Đi ngủ và thức dậy đúng giờ mỗi ngày</li>
                    <li>Tạo môi trường ngủ thoải mái: tối, yên tĩnh, mát mẻ</li>
                    <li>Tránh caffeine và rượu trước khi ngủ</li>
                    <li>Tắt các thiết bị điện tử 1 giờ trước khi ngủ</li>
                    <li>Tập thể dục thường xuyên nhưng không quá gần giờ ngủ</li>
                </ol>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Cách xử lý khi bị bỏng',
                'content' => '<h2>Bỏng là tổn thương da do nhiệt, hóa chất, điện hoặc bức xạ</h2>
                <p><strong>Phân loại bỏng:</strong></p>
                <ul>
                    <li><strong>Bỏng độ 1:</strong> Chỉ ảnh hưởng lớp ngoài da, đỏ, đau nhẹ</li>
                    <li><strong>Bỏng độ 2:</strong> Ảnh hưởng lớp dưới da, có bọng nước, đau nhiều</li>
                    <li><strong>Bỏng độ 3:</strong> Tổn thương sâu, da trắng hoặc đen, có thể mất cảm giác</li>
                </ul>
                <p><strong>Cách xử lý bỏng nhẹ (độ 1, độ 2 nhỏ):</strong></p>
                <ol>
                    <li><strong>Làm mát ngay:</strong> Ngâm vùng bỏng vào nước lạnh 10-15 phút, không dùng nước đá.</li>
                    <li><strong>Bảo vệ vết bỏng:</strong> Băng nhẹ bằng gạc vô trùng, không băng quá chặt.</li>
                    <li><strong>Giảm đau:</strong> Có thể dùng thuốc giảm đau không kê đơn.</li>
                    <li><strong>Không chọc bọng nước:</strong> Để tránh nhiễm trùng.</li>
                    <li><strong>Không bôi kem, dầu:</strong> Chỉ bôi kem chống bỏng chuyên dụng.</li>
                </ol>
                <p><strong>Khi nào cần đến bệnh viện:</strong></p>
                <ul>
                    <li>Bỏng độ 3</li>
                    <li>Bỏng diện tích lớn (lớn hơn lòng bàn tay)</li>
                    <li>Bỏng ở mặt, tay, chân, bộ phận sinh dục</li>
                    <li>Bỏng do hóa chất hoặc điện</li>
                    <li>Có dấu hiệu nhiễm trùng: sưng, mủ, sốt</li>
                </ul>
                <p><strong>Lưu ý:</strong> Không tự ý xử lý bỏng nặng, hãy đến cơ sở y tế ngay lập tức.</p>',
                'status' => 'published',
                'author_id' => $admin->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }

        $this->command->info('Đã tạo ' . count($posts) . ' bài viết thành công!');
    }
}

