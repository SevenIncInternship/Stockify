<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Stockify'); ?></title>

    <!-- Vite Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

<?php if(auth()->guard()->check()): ?>
    <!-- Layout untuk user login -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col ml-64"> 
            <!-- Navbar -->
            <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
                <div class="text-xl font-bold text-green-700"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></div>
                <div>
                    <span class="text-gray-700 mr-4">Selamat datang, <span class="font-semibold"><?php echo e(Auth::user()->name); ?></span></span>
                    <a href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();"
                       class="text-red-600 hover:underline">
                        Logout
                    </a>
                    <form id="logout-form-nav" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </nav>

            <!-- Konten -->
            <main class="flex-1 w-full px-6 py-6"> 
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow-inner py-4 text-center text-sm text-gray-500 mt-auto">
                &copy; <?php echo e(date('Y')); ?> Stockify Warehouse System. All rights reserved.
            </footer>
        </div>
    </div>
<?php else: ?>
    <!-- Layout untuk tamu -->
    <main class="min-h-screen flex items-center justify-center p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
<?php endif; ?>

</body>
</html>
<?php /**PATH D:\KULIAH\KP\REPO\Stockify\resources\views/layouts/app.blade.php ENDPATH**/ ?>