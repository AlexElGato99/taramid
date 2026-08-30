<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex items-center justify-center">
        <div class="flex justify-between flex-1 sm:hidden">
            <?php if($paginator->onFirstPage()): ?>
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-ash/40 bg-surface border border-gray-200 rounded-full cursor-default">
                    <?php echo __('pagination.previous'); ?>

                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-ink bg-white border border-gray-200 rounded-full hover:bg-surface transition-colors">
                    <?php echo __('pagination.previous'); ?>

                </a>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-ink bg-white border border-gray-200 rounded-full hover:bg-surface transition-colors">
                    <?php echo __('pagination.next'); ?>

                </a>
            <?php else: ?>
                <span class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-ash/40 bg-surface border border-gray-200 rounded-full cursor-default">
                    <?php echo __('pagination.next'); ?>

                </span>
            <?php endif; ?>
        </div>

        <div class="hidden sm:flex sm:items-center sm:gap-1">
            
            <?php if($paginator->onFirstPage()): ?>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-ash/30 cursor-default">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="inline-flex items-center justify-center w-10 h-10 rounded-full text-ash hover:text-ink hover:bg-surface transition-colors" aria-label="<?php echo e(__('pagination.previous')); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_string($element)): ?>
                    <span class="inline-flex items-center justify-center w-10 h-10 text-sm text-ash cursor-default"><?php echo e($element); ?></span>
                <?php endif; ?>

                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <span aria-current="page" class="inline-flex items-center justify-center w-10 h-10 rounded-full text-sm font-semibold text-white bg-primary"><?php echo e($page); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" class="inline-flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium text-ash hover:text-ink hover:bg-surface transition-colors" aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>"><?php echo e($page); ?></a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="inline-flex items-center justify-center w-10 h-10 rounded-full text-ash hover:text-ink hover:bg-surface transition-colors" aria-label="<?php echo e(__('pagination.next')); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            <?php else: ?>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-ash/30 cursor-default">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            <?php endif; ?>
        </div>
    </nav>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>