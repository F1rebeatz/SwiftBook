<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-2xl mx-auto mt-8 p-4">
        <h1 class="text-3xl font-semibold mb-4">Reviews for <?php echo e($hotel->title); ?></h1>

        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-4 rounded shadow mb-4">
                <p class="font-bold">User: <?php echo e($review->user->name); ?></p>
                <p class="text-gray-600">Rating: <?php echo e($review->rating); ?></p>
                <p class="text-gray-600">Created at: <?php echo e($review->created_at->format('Y-m-d H:i:s')); ?></p>
                <p class="mt-2 font-bold"><?php echo e($review->comment); ?></p>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->id === $review->user->id): ?>
                        <a href="<?php echo e(route('reviews.edit', $review->id)); ?>" class="text-blue-500 hover:underline">Edit</a>
                        <form action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="post" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($reviews->links()); ?>


        <?php if(auth()->guard()->check()): ?>
            <?php if($message = Session::get('success')): ?>
                <?php if (isset($component)) { $__componentOriginal8c25e3da2645eb99478f0fc7d7cd0c77 = $component; } ?>
<?php $component = App\View\Components\SuccessAlert::resolve(['message' => $message] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SuccessAlert::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c25e3da2645eb99478f0fc7d7cd0c77)): ?>
<?php $component = $__componentOriginal8c25e3da2645eb99478f0fc7d7cd0c77; ?>
<?php unset($__componentOriginal8c25e3da2645eb99478f0fc7d7cd0c77); ?>
<?php endif; ?>
            <?php elseif($message = Session::get('error')): ?>
                <?php if (isset($component)) { $__componentOriginalb130abc79597b624a5cecf803e64ec72 = $component; } ?>
<?php $component = App\View\Components\ErrorAlert::resolve(['message' => $message] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ErrorAlert::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb130abc79597b624a5cecf803e64ec72)): ?>
<?php $component = $__componentOriginalb130abc79597b624a5cecf803e64ec72; ?>
<?php unset($__componentOriginalb130abc79597b624a5cecf803e64ec72); ?>
<?php endif; ?>
            <?php endif; ?>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Leave a Review</h2>
                <form action="<?php echo e(route('reviews.store', $hotel->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-600">Rating:</label>
                        <input type="number" name="rating" id="rating" class="mt-1 p-2 border rounded w-full" min="1" max="5" required>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-600">Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 p-2 border rounded w-full"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Review</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\sites\SwiftBook\resources\views/reviews/index.blade.php ENDPATH**/ ?>