<?php $__env->startSection('content'); ?>
<div class="min-h-screen h-full w-auto flex flex-col items-center justify-center bg-gradient-to-r from-gray-400 to-blue-200 text-black text-center">
    <div>
        <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo" class="mx-auto max-w-md w-full h-auto float-none shadow-md">
    </div>
    <div class="">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Selamat Datang di Stockify</h1>
        <p class="text-lg md:text-xl mb-6">Kelola stok barangmu dengan mudah dan cepat.</p>
    </div>

    <div class="space-x-4">
        <a href="<?php echo e(route('login')); ?>"
           class="bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-200 transition">
            Get Started
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KULIAH\KP\REPO\Stockify\Stockify\resources\views/welcome.blade.php ENDPATH**/ ?>