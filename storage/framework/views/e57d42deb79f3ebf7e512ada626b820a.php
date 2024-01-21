<div <?php echo e($attributes->merge(['class' => 'flex flex-col md:flex-row shadow-md'])); ?>>
    <div class="h-full w-full md:w-2/5">
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url(<?php echo e($room->poster_url); ?>)">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between">
        <div class="pb-2">
            <div class="text-xl font-bold">
                <?php echo e($room->title); ?>

            </div>
            <div class="pt-2">
                <span class="text-2xl text-grey-darkest"><?php echo e($room->price); ?>₽</span>
                <span class="text-lg"> за ночь</span>
            </div>
            <div>
               <span><?php echo e(__('Этаж')); ?></span> <?php echo e($room->floor_area); ?> м
            </div>
            <div><span>Удобства:</span></div>
            <div>
                    <?php $__currentLoopData = $room->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span>• <?php echo e($facility->title); ?> </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2">
            <div class="flex flex-col">
                <span class="text-lg font-bold"><?php echo e($room->total_price); ?> руб.</span>
                <span>за <?php echo e($room->total_days); ?> ночей</span>
            </div>
            <form class="ml-4" method="POST" action="<?php echo e(route('bookings.store', ['id' => $room->hotel_id])); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="started_at" value="<?php echo e(request()->get('start_date', \Carbon\Carbon::now()->format('Y-m-d'))); ?>">
                <input type="hidden" name="finished_at" value="<?php echo e(request()->get('end_date', \Carbon\Carbon::now()->addDay()->format('Y-m-d'))); ?>">
                <input type="hidden" name="room_id" value="<?php echo e($room->id); ?>">
                <input type="hidden" name="price" value="<?php echo e($room->total_price); ?>">
                <input type="hidden" name="days" value="<?php echo e($room->total_days); ?>">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.the-button','data' => ['class' => ' h-full w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('the-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ' h-full w-full']); ?><?php echo e(__('Book')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sites\SwiftBook\resources\views/components/rooms/room-list-item.blade.php ENDPATH**/ ?>