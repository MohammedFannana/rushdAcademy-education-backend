


<?php $__env->startSection('content'); ?>
  
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(trans('admin/main.translation')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#"><?php echo e(trans('admin/main.dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(trans('admin/main.translation')); ?></div>
            </div>
        </div>

        <div class="section-body">
            

            <div class="row">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_settings_customization')): ?>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                
                                <a href="<?php echo e(route('translation_data_sync')); ?>" class="btn btn-info">Translation Data Sync</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\project\gazacademy\resources\views/admin/translation/index.blade.php ENDPATH**/ ?>