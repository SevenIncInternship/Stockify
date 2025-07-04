<?php $__env->startSection('title', 'Daftar Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6 bg-white rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
        <a href="<?php echo e(route('admin.supplier.create')); ?>"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah Supplier
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 font-medium">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Alamat</th>
                    <th class="p-3 border">Telepon</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="text-sm text-gray-600">
                    <td class="p-3 border"><?php echo e($loop->iteration); ?></td>
                    <td class="p-3 border"><?php echo e($supplier->nama); ?></td>
                    <td class="p-3 border"><?php echo e($supplier->alamat); ?></td>
                    <td class="p-3 border"><?php echo e($supplier->telepon); ?></td>
                    <td class="p-3 border">
                        <a href="<?php echo e(route('admin.supplier.edit', $supplier->id)); ?>"
                           class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="<?php echo e(route('admin.supplier.destroy', $supplier->id)); ?>" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data supplier.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KULIAH\KP\REPO\Stockify\resources\views/admin/suppliers/index.blade.php ENDPATH**/ ?>