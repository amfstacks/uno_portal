<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>
<?php
$sessions = ['2024/2025','2025/2026'];
$levels = ['100','200'];
?>
<div x-data="paymentHistory()" class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold primary-text">Payment History</h2>
            <p class="text-gray-600">All school payments you have made over time.</p>
        </div>

        <!-- SEARCH INPUT -->
        <input 
            x-model="search"
            type="text" 
            placeholder="Search by reference, type, or session..."
            class="border px-4 py-2 rounded-lg w-full md:w-72 focus:ring-primary focus:border-primary"
        >
    </div>


    <!-- FILTERS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <!-- Session Filter -->
        <select x-model="filters.session"
            class="border px-3 py-2 rounded-lg focus:ring-primary focus:border-primary">
            <option value="">All Sessions</option>
            <?php foreach ($sessions as $s): ?>
                <option value="<?= esc($s) ?>"><?= esc($s) ?></option>
            <?php endforeach; ?>
        </select>


        <!-- Level Filter -->
        <select x-model="filters.level"
            class="border px-3 py-2 rounded-lg focus:ring-primary focus:border-primary">
            <option value="">All Levels</option>
            <?php foreach ($levels as $l): ?>
                <option value="<?= esc($l) ?>"><?= esc($l) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Payment Type Filter -->
      

        <!-- RESET FILTER BUTTON -->
        <button 
            @click="resetFilters()"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg">
            Reset Filters
        </button>
    </div>


    <!-- PAYMENT TABLE -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <?php if (empty($payments)): ?>
            <div class="p-4 bg-blue-50 text-blue-700 rounded-lg border-l-4 border-blue-400">
                You have not made any payments yet.
            </div>

        <?php else: ?>

            <div class="overflow-auto rounded-lg border max-h-[650px]">
                <table class="min-w-full">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Payment Type</th>
                            <th class="px-4 py-3 text-left">Amount</th>
                            <th class="px-4 py-3 text-left">Session</th>
                            <th class="px-4 py-3 text-left">Level</th>
                            <th class="px-4 py-3 text-left">Semester</th>
                            <th class="px-4 py-3 text-left">Reference</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-left">Date Paid</th>
                            <th class="px-4 py-3 text-center">Receipt</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y text-sm">
                        <?php $i = 1; ?>
                        <?php foreach ($payments as $p): ?>
                            <tr 
                                class="hover:bg-gray-50"
                                x-show="matchesFilters('<?= esc($p['session']) ?>', '<?= esc($p['level']) ?>', '<?= esc($p['payment_type']) ?>', '<?= esc($p['reference']) ?>')"
                            >
                                <td class="px-4 py-2"><?= $i++ ?></td>

                                <td class="px-4 py-2 font-medium">
                                    <?= esc(ucfirst($p['payment_type'])) ?>
                                </td>

                                <td class="px-4 py-2 font-semibold">
                                    ₦<?= number_format($p['amount_paid'], 2) ?>
                                </td>

                                <td class="px-4 py-2"><?= esc($p['session']) ?></td>
                                <td class="px-4 py-2"><?= esc($p['level']) ?></td>
                                <td class="px-4 py-2"><?= esc($p['semester']) ?></td>

                                <td class="px-4 py-2 text-blue-600 font-medium">
                                    <?= esc($p['reference']) ?>
                                </td>

                                <td class="px-4 py-2 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-white text-xs 
                                        <?= $p['status'] === 'successful' ? 'bg-green-600' : 'bg-yellow-600' ?>">
                                        <?= esc(ucfirst($p['status'])) ?>
                                    </span>
                                </td>

                                <td class="px-4 py-2">
                                    <?= date('d M Y h:i A', strtotime($p['paid_at'])) ?>
                                </td>

                                <!-- DOWNLOAD RECEIPT -->
                                <td class="px-4 py-2 text-center">
                                    <a href="/student/receipt/<?= $p['id'] ?>"
                                        class="text-primary hover:underline font-medium">
                                        Download
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-4 flex justify-end">

            </div>

        <?php endif; ?>

    </div>

</div>


<!-- ALPINE JS FILTER LOGIC -->
<script>
function paymentHistory() {
    return {
        search: "",
        filters: {
            session: "",
            level: "",
            payment_type: "",
        },

        resetFilters() {
            this.search = "";
            this.filters.session = "";
            this.filters.level = "";
            this.filters.payment_type = "";
        },

        matchesFilters(session, level, type, reference) {
            // Text search
            let s = this.search.toLowerCase();
            if (s && !(
                session.toLowerCase().includes(s) ||
                level.toLowerCase().includes(s) ||
                type.toLowerCase().includes(s) ||
                reference.toLowerCase().includes(s)
            )) return false;

            // Filters
            if (this.filters.session && this.filters.session !== session) return false;
            if (this.filters.level && this.filters.level !== level) return false;
            if (this.filters.payment_type && this.filters.payment_type !== type) return false;

            return true;
        }
    }
}
</script>

<?= $this->endSection() ?>
