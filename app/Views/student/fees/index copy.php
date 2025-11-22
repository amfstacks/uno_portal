<div class="bg-white rounded-xl shadow-sm border p-6">
    <h2 class="text-2xl font-bold mb-6">Fee Breakdown - <?= active_session() ?></h2>
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-lg text-center">
            <p class="text-sm text-gray-600">Total Fees</p>
            <p class="text-3xl font-bold">₦<?= number_format($total) ?></p>
        </div>
        <div class="bg-green-50 p-6 rounded-lg text-center">
            <p class="text-sm text-gray-600">Paid</p>
            <p class="text-3xl font-bold text-green-600">₦<?= number_format($paid) ?></p>
        </div>
        <div class="bg-red-50 p-6 rounded-lg text-center">
            <p class="text-sm text-gray-600">Balance</p>
            <p class="text-3xl font-bold text-red-600">₦<?= number_format($balance) ?></p>
        </div>
    </div>

    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Fee Type</th>
                <th class="px-4 py-3 text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fees as $f): ?>
            <tr>
                <td class="px-4 py-3"><?= ucfirst($f['fee_type']) ?></td>
                <td class="px-4 py-3 text-right font-medium">₦<?= number_format($f['amount']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>