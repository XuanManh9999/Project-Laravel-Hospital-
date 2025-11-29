

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-badge display-4 text-primary"></i>
                    <h3 class="mt-3"><?php echo e($stats['total_doctors']); ?></h3>
                    <p class="text-muted mb-0">Tổng số bác sĩ</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-people display-4 text-success"></i>
                    <h3 class="mt-3"><?php echo e($stats['total_patients']); ?></h3>
                    <p class="text-muted mb-0">Tổng số bệnh nhân</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-calendar-check display-4 text-info"></i>
                    <h3 class="mt-3"><?php echo e($stats['total_appointments']); ?></h3>
                    <p class="text-muted mb-0">Tổng số lịch hẹn</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-clock-history display-4 text-warning"></i>
                    <h3 class="mt-3"><?php echo e($stats['pending_appointments']); ?></h3>
                    <p class="text-muted mb-0">Lịch hẹn chờ xử lý</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-clipboard-check display-4 text-success"></i>
                    <h4 class="mt-3"><?php echo e($stats['accepted_appointments']); ?></h4>
                    <p class="text-muted mb-0">Lịch hẹn đã chấp nhận</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-check2-circle display-4 text-primary"></i>
                    <h4 class="mt-3"><?php echo e($stats['completed_appointments']); ?></h4>
                    <p class="text-muted mb-0">Lịch hẹn hoàn thành</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-x-circle display-4 text-danger"></i>
                    <h4 class="mt-3"><?php echo e($stats['rejected_appointments']); ?></h4>
                    <p class="text-muted mb-0">Lịch hẹn bị từ chối</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-slash-circle display-4 text-secondary"></i>
                    <h4 class="mt-3"><?php echo e($stats['cancelled_appointments']); ?></h4>
                    <p class="text-muted mb-0">Lịch hẹn đã hủy</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-cash-coin display-4 text-success"></i>
                    <h4 class="mt-3"><?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?> đ</h4>
                    <p class="text-muted mb-0">Tổng doanh thu</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-cash-stack display-4 text-primary"></i>
                    <h4 class="mt-3"><?php echo e(number_format($stats['today_revenue'], 0, ',', '.')); ?> đ</h4>
                    <p class="text-muted mb-0">Doanh thu hôm nay</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-calendar-range display-4 text-info"></i>
                    <h4 class="mt-3"><?php echo e(number_format($stats['month_revenue'], 0, ',', '.')); ?> đ</h4>
                    <p class="text-muted mb-0">Doanh thu tháng này</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-credit-card display-4 text-warning"></i>
                    <h4 class="mt-3"><?php echo e($stats['successful_payments']); ?> / <?php echo e($stats['total_payments']); ?></h4>
                    <p class="text-muted mb-0">Thanh toán thành công / tổng số</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-arrow-repeat display-4 text-warning"></i>
                    <h4 class="mt-3"><?php echo e($stats['pending_refunds']); ?></h4>
                    <p class="text-muted mb-0">Yêu cầu hoàn tiền chờ xử lý</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-check-all display-4 text-success"></i>
                    <h4 class="mt-3"><?php echo e($stats['processed_refunds']); ?></h4>
                    <p class="text-muted mb-0">Yêu cầu hoàn tiền đã xử lý</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Biểu đồ doanh thu thanh toán</h5>
            </div>

            <form method="GET" class="mb-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label mb-1">Từ ngày</label>
                        <input type="date" name="date_from" class="form-control" value="<?php echo e($chartData['date_from']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Đến ngày</label>
                        <input type="date" name="date_to" class="form-control" value="<?php echo e($chartData['date_to']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Nhóm theo</label>
                        <select name="group_by" class="form-select">
                            <option value="day" <?php echo e($chartData['group_by'] === 'day' ? 'selected' : ''); ?>>Ngày</option>
                            <option value="month" <?php echo e($chartData['group_by'] === 'month' ? 'selected' : ''); ?>>Tháng</option>
                            <option value="year" <?php echo e($chartData['group_by'] === 'year' ? 'selected' : ''); ?>>Năm</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;

            const labels = <?php echo json_encode($chartData['labels'], 15, 512) ?>;
            const totals = <?php echo json_encode($chartData['totals'], 15, 512) ?>;
            const orders = <?php echo json_encode($chartData['orders'], 15, 512) ?>;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Doanh thu (đ)',
                            data: totals,
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13,110,253,0.1)',
                            tension: 0.25,
                            yAxisID: 'y',
                        },
                        {
                            label: 'Số giao dịch',
                            data: orders,
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25,135,84,0.1)',
                            borderDash: [5, 5],
                            tension: 0.25,
                            yAxisID: 'y1',
                        },
                    ],
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    stacked: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            ticks: {
                                callback: function (value) {
                                    return new Intl.NumberFormat('vi-VN').format(value);
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    if (context.dataset.yAxisID === 'y') {
                                        const value = new Intl.NumberFormat('vi-VN').format(context.parsed.y);
                                        return `${label}: ${value} đ`;
                                    }
                                    return `${label}: ${context.parsed.y}`;
                                }
                            }
                        },
                        legend: {
                            display: true,
                        },
                    },
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>