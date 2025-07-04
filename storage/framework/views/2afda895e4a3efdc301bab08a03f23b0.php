<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Home')); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>


    
</head>
<body class="font-sans antialiased">
     <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if(session('status')): ?>
        <div class="bg-green-100 text-green-800 px-4 py-2 text-sm text-center">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <main class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH D:\KULIAH\KP\REPO\Stockify\Stockify\resources\views/layouts/app.blade.php ENDPATH**/ ?>