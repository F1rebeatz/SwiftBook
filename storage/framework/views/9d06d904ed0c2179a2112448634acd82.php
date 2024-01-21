<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['facilities', 'selectedFacilities']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['facilities', 'selectedFacilities']); ?>
<?php foreach (array_filter((['facilities', 'selectedFacilities']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>
    <form action="<?php echo e(route('hotels.index')); ?>" method="get" class="mb-4">
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700"><?php echo e(__('Search for a hotel by name or address:')); ?></label>
            <div class="flex items-center">
                <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" class="mt-1 p-2 border rounded-md w-full">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <?php echo e(__('Search')); ?>

                </button>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700"><?php echo e(__('Facilities:')); ?></label>
            <div class="mt-2 space-y-2">
                <?php if(isset($facilities) && $facilities->isNotEmpty()): ?>
                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center">
                            <input type="checkbox" name="facilities[]" value="<?php echo e($facility->id); ?>" <?php echo e(in_array($facility->id, $selectedFacilities) ? 'checked' : ''); ?> class="mr-2">
                            <span class="text-sm"><?php echo e($facility->title); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\sites\SwiftBook\resources\views/components/hotel-filter.blade.php ENDPATH**/ ?>