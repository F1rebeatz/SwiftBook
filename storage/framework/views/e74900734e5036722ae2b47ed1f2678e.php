<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="<?php echo e($hotel->poster_url); ?>" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="<?php echo e(route('hotels.show', ['id' => $hotel->id])); ?>"><?php echo e($hotel->title); ?></a>
            <div class="text-xs">
                <?php echo e($hotel->address); ?>

            </div>
        </div>
        <span class="text-lg pt-2">Удобства:</span>
        <?php if($hotel->facilities->isNotEmpty()): ?>
            <div class="flex items-center py-2">
                <?php $__currentLoopData = $hotel->facilities->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="pr-2 text-xs">
                        <span>•</span> <?php echo e($facility->title); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="flex justify-end">
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.link-button','data' => ['href' => ''.e(route('hotels.show', ['id' => $hotel->id])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('hotels.show', ['id' => $hotel->id])).'']); ?>Подробнее <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sites\SwiftBook\resources\views/components/hotels/hotel-card.blade.php ENDPATH**/ ?>