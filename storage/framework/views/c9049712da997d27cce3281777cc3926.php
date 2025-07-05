<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-extrabold text-gray-800">Buat Akun Baru</h2>
            <p class="mt-2 text-sm text-gray-500">Mulai kelola stokmu bersama <span class="font-semibold text-blue-500">Stockify</span></p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>

            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>

            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>

            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>

            
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>

            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Peran</label>
                <select name="role" id="role" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">Pilih peran</option>
                    <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                    <option value="manajer" <?php echo e(old('role') == 'manajer' ? 'selected' : ''); ?>>Manajer</option>
                    <option value="staff" <?php echo e(old('role') == 'staff' ? 'selected' : ''); ?>>Staff Gudang</option>
                </select>
            </div>

            
            <div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 px-4 rounded-md hover:from-blue-600 hover:to-indigo-700 shadow-lg transition-all font-semibold">
                    Daftar
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>" class="text-blue-600 font-medium hover:underline">Login di sini</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KULIAH\KP\REPO\Stockify\resources\views/register.blade.php ENDPATH**/ ?>