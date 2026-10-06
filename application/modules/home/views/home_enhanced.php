<?php
/**
 * Enhanced Modern Hospital Management Dashboard
 * Built with Tailwind CSS for a modern, responsive, and professional medical interface
 */
?>

<script type="text/javascript" src="common/js/google-loader.js"></script>

<!-- Main Content Wrapper with Tailwind Styling -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    
    <!-- Header Section with Welcome Message -->
    <section class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Welcome Section -->
                <div class="flex items-center space-x-4">
                    <?php
                    $user_id = $this->ion_auth->user()->row()->id;
                    $user_image = $this->db->get_where('users', array('id' => $user_id))->row()->img_url;
                    $default_image = 'uploads/default.png';
                    ?>
                    <div class="relative">
                        <img src="<?php echo $user_image ? base_url() . $user_image : base_url() . $default_image; ?>"
                             alt="User Avatar"
                             class="w-16 h-16 rounded-full ring-4 ring-blue-100 shadow-lg object-cover">
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-2 border-white rounded-full"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            <?php echo lang('welcome') ?>, 
                            <?php
                            $username = $this->ion_auth->user()->row()->username;
                            echo !empty($username) ? $username : '';
                            ?>!
                        </h1>
                        <p class="text-gray-600 mt-1">Welcome to the dashboard of <?php echo $settings->title ?? ''; ?></p>
                    </div>
                </div>
                
                <!-- Time and Date -->
                <div class="text-right">
                    <div class="text-sm text-gray-500">Today</div>
                    <div class="text-lg font-semibold text-gray-900" id="current-time">
                        <?php echo date('l, F j, Y'); ?>
                    </div>
                    <div class="text-sm text-blue-600" id="live-time">
                        <?php echo date('g:i A'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Financial Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Today's Payment Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Today's Payment</p>
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo $settings->currency; ?><?php echo format_number_short($this_day['payment'] ?? 0, 2, '.', ','); ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-green-600 font-medium">
                                        <?php 
                                        $bill_change = $percentage_change_bill ?? 0;
                                        echo $bill_change >= 0 ? '+' : '';
                                        echo $bill_change;
                                        ?>% from yesterday
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Deposit Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Today's Deposit</p>
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo $settings->currency; ?><?php echo format_number_short($this_day['deposit'] ?? 0, 2, '.', ','); ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-blue-600 font-medium">
                                        <?php 
                                        $deposit_change = $percentage_change_deposit ?? 0;
                                        echo $deposit_change >= 0 ? '+' : '';
                                        echo $deposit_change;
                                        ?>% from yesterday
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Expense Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Today's Expense</p>
                                <div class="p-2 bg-red-100 rounded-lg">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo $settings->currency; ?><?php echo format_number_short($this_day['expense'] ?? 0, 2, '.', ','); ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-red-600 font-medium">
                                        <?php 
                                        $expense_change = $percentage_change_expense ?? 0;
                                        echo $expense_change >= 0 ? '+' : '';
                                        echo $expense_change;
                                        ?>% from yesterday
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Appointments Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Today's Appointments</p>
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo $this_day['appointment'] ?? 0; ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-purple-600 font-medium">Active appointments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hospital Statistics Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            
            <!-- Patient Statistics Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Patient Statistics</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Registered Today</span>
                        <span class="text-lg font-bold text-green-600"><?php echo $registeredToday ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Admitted Today</span>
                        <span class="text-lg font-bold text-blue-600"><?php echo $admittedToday ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Discharged Today</span>
                        <span class="text-lg font-bold text-purple-600"><?php echo $dischargedToday ?? 0; ?></span>
                    </div>
                </div>
            </div>

            <!-- Staff on Duty Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Staff on Duty</h3>
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Doctors</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full"><?php echo $doctorsOnDuty ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Nurses</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full"><?php echo $nursesOnDuty ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pharmacists</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full"><?php echo $pharmacistsOnDuty ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Lab Technicians</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full"><?php echo $laboratoristsOnDuty ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Receptionists</span>
                        <span class="px-2 py-1 bg-pink-100 text-pink-800 text-xs font-medium rounded-full"><?php echo $receptionistsOnDuty ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Accountants</span>
                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full"><?php echo $accountantsOnDuty ?? 0; ?></span>
                    </div>
                </div>
            </div>

            <!-- Bed Occupancy Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Bed Occupancy</h3>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <?php if (!empty($bedCategoryWiseOccupancy)): ?>
                        <?php foreach ($bedCategoryWiseOccupancy as $category => $data): ?>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700"><?php echo ucfirst($category); ?></span>
                                    <span class="text-xs text-gray-500"><?php echo $data['occupied']; ?>/<?php echo $data['total']; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <?php 
                                    $occupancy_percentage = $data['total'] > 0 ? ($data['occupied'] / $data['total']) * 100 : 0;
                                    $bar_color = $occupancy_percentage > 80 ? 'bg-red-500' : ($occupancy_percentage > 60 ? 'bg-yellow-500' : 'bg-green-500');
                                    ?>
                                    <div class="<?php echo $bar_color; ?> h-2 rounded-full transition-all duration-300" style="width: <?php echo $occupancy_percentage; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No bed data available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Analytics and Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Monthly Performance Chart -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Performance</h3>
                <div class="relative h-64">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <!-- Top Diagnoses -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Diagnoses (Last 30 Days)</h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($topDiagnoses)): ?>
                        <?php 
                        $diagnoses_list = $this->home_model->getDiagnosis();
                        $diagnosis_map = [];
                        foreach ($diagnoses_list as $diag) {
                            $diagnosis_map[$diag->id] = $diag->diagnosis;
                        }
                        foreach ($topDiagnoses as $diagnosis_id => $count): 
                        ?>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700"><?php echo $diagnosis_map[$diagnosis_id] ?? 'Unknown'; ?></span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full"><?php echo $count; ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No diagnosis data available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Revenue and Medicine Alerts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Top Revenue Services -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Revenue Generating Services</h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($topRevenueGeneratingServices)): ?>
                        <?php 
                        $payment_categories_list = $this->home_model->getPaymentCategories();
                        $category_map = [];
                        foreach ($payment_categories_list as $cat) {
                            $category_map[$cat->id] = $cat->category;
                        }
                        foreach ($topRevenueGeneratingServices as $category_id => $revenue): 
                        ?>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700"><?php echo $category_map[$category_id] ?? 'Unknown Service'; ?></span>
                                <span class="text-sm font-bold text-green-600"><?php echo $settings->currency; ?><?php echo number_format($revenue, 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No revenue data available</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Low Stock Medicines Alert -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Low Stock Medicines</h3>
                    <div class="p-1 bg-red-100 rounded-lg">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($lowStockMedicines)): ?>
                        <?php foreach ($lowStockMedicines as $medicine): ?>
                            <div class="flex justify-between items-center p-3 bg-red-50 border border-red-200 rounded-lg">
                                <div>
                                    <span class="text-sm font-medium text-gray-700"><?php echo $medicine->name; ?></span>
                                    <p class="text-xs text-gray-500"><?php echo $medicine->generic_name; ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-bold text-red-600"><?php echo $medicine->quantity; ?> left</span>
                                    <p class="text-xs text-gray-500">Alert: <?php echo $medicine->stock_alert; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <svg class="w-12 h-12 text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <p class="text-sm text-green-600 font-medium">All medicines are well stocked!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Disease Outbreak Monitoring -->
        <?php if (!empty($diseasesWithOutbreakPotential)): ?>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Disease Outbreak Monitoring</h3>
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php 
                $disease_map = [];
                foreach ($diseasesWithOutbreakPotential as $disease) {
                    $disease_map[$disease->id] = $disease;
                }
                foreach ($cases as $disease_id => $ratio): 
                    $disease_info = $disease_map[$disease_id];
                    $alert_level = $ratio >= 1 ? 'high' : ($ratio >= 0.7 ? 'medium' : 'low');
                    $alert_color = $alert_level == 'high' ? 'red' : ($alert_level == 'medium' ? 'yellow' : 'green');
                ?>
                    <div class="p-4 border-l-4 border-<?php echo $alert_color; ?>-500 bg-<?php echo $alert_color; ?>-50 rounded-lg">
                        <h4 class="font-medium text-gray-900"><?php echo $disease_info->disease_name; ?></h4>
                        <p class="text-sm text-gray-600 mt-1">Current: <?php echo $this->home_model->getCasesNumberForOutbreakDisease($disease_id); ?> cases</p>
                        <p class="text-sm text-gray-600">Expected: <?php echo $disease_info->maximum_expected_number_of_patient_in_a_week; ?> per week</p>
                        <div class="mt-2">
                            <span class="text-xs px-2 py-1 bg-<?php echo $alert_color; ?>-200 text-<?php echo $alert_color; ?>-800 rounded-full font-medium">
                                <?php echo ucfirst($alert_level); ?> Risk (<?php echo number_format($ratio * 100, 1); ?>%)
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Recent Appointments -->
        <?php if (!empty($appointments)): ?>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Appointments</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach (array_slice($appointments, 0, 5) as $appointment): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo $appointment->patient_name; ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo $appointment->doctor_name; ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo date('g:i A', strtotime($appointment->time)); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $appointment->status == 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?php echo $appointment->status; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

    </main>
</div>

<!-- Chart.js for Analytics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Live time update
function updateTime() {
    const now = new Date();
    const timeElement = document.getElementById('live-time');
    if (timeElement) {
        timeElement.textContent = now.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }
}

// Update time every minute
setInterval(updateTime, 60000);

// Monthly Performance Chart
const ctx = document.getElementById('monthlyChart');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($this_year['payment_per_month'] ?? [])); ?>,
            datasets: [{
                label: 'Payments',
                data: <?php echo json_encode(array_values($this_year['payment_per_month'] ?? [])); ?>,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Expenses',
                data: <?php echo json_encode(array_values($this_year['expense_per_month'] ?? [])); ?>,
                borderColor: 'rgb(239, 68, 68)',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '<?php echo $settings->currency; ?>' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
}

// Add smooth scrolling and animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on load
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<!-- Custom Styles for Enhanced UI -->
<style>
.bg-gradient-to-br {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.hover\:shadow-xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.transform:hover {
    transform: translateY(-4px);
}

/* Custom scrollbar */
.overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
</style>
