<aside id="sidebar"
       class="fixed top-14 xl:top-14 group bottom-0 left-0 bg-white lg:flex lg:translate-x-0 lg:right-auto lg:bottom-0 flex flex-col z-50 dark:bg-gray-950 w-full lg:w-56 lg:py-0 py-3 border-r border-gray-200 dark:border-gray-800" :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'" @click.outside="sidebarToggle = false">
    <ul class="flex flex-col overflow-y-auto px-3 h-[calc(100%-6rem)] text-xs pb-8 flex-1 text-gray-500 dark:text-gray-500"
        x-data="{selected: <?php if(isset($config['nav'])): ?><?php echo e("'".$config['nav']."'"); ?><?php else: ?><?php echo e("'main'"); ?><?php endif; ?>}">

        <?php $__currentLoopData = config('attr.admin'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($value['header']) AND $value['header'] == 'true'): ?>
                <li class="text-gray-300 dark:text-gray-500 px-3 text-[10px] uppercase tracking-wider mb-3 <?php echo e($value['class']); ?>">
                    <?php echo e($value['title']); ?>

                </li>
            <?php elseif(isset($value['line']) AND $value['line'] == 'true'): ?>
                <li class="border-t border-gray-100/60 dark:border-gray-800 my-5 <?php echo e($value['class']); ?> <?php if(isset($value['class'])): ?><?php echo e($value['class']); ?><?php endif; ?>"></li>

            <?php elseif(isset($value['type']) AND $value['type'] == 'link'): ?>
                <li>
                    <a href=""
                       class="hover:underline hover:dark:bg-gray-800/50 hover:dark:text-white hover:text-gray-700 rounded-md dark:text-gray-400 py-1.5 px-3 flex items-center gap-3 ease-in-out duration-300">
                        <?php if(isset($value['icon'])): ?>
                            <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => ''.e($value['icon']).'','class' => 'w-4 h-4','stroke' => 'currentColor','strokeWidth' => '1.75']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($value['icon']).'','class' => 'w-4 h-4','stroke' => 'currentColor','stroke-width' => '1.75']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                        <?php endif; ?>
                        <div class="flex-1 dark:font-normal"><?php echo e(__($value['title'])); ?></div>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php if(isset($value['menu'])): ?><?php echo e('javascript:;'); ?><?php elseif(Route::has($key)): ?><?php echo e(route($key)); ?><?php endif; ?>"
                       class="font-medium hover:bg-gray-100 hover:dark:bg-gray-800/50 hover:dark:text-white hover:text-gray-700 rounded-md dark:text-gray-400 py-2 px-3 flex items-center gap-x-3 ease-in-out duration-300"
                       <?php if(isset($value['menu'])): ?>
                       @click.prevent="selected !== '<?php echo e($value['nav']); ?>' ? selected = '<?php echo e($value['nav']); ?>' : selected = false"
                       <?php endif; ?>
                       x-bind:class="selected === '<?php echo e($value['nav']); ?>' ? 'dark:text-white text-gray-600 bg-gray-100 dark:bg-gray-800/50': ''">

                        <?php if(isset($value['icon'])): ?>
                            <div class="w-4 h-4 flex items-center justify-center">
                                <?php if (isset($component)) { $__componentOriginal56804098dcf376a0e2227cb77b6cd00a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon','data' => ['name' => ''.e($value['icon']).'','class' => 'w-4 h-4','stroke' => 'currentColor','strokeWidth' => '1.75']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ui.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($value['icon']).'','class' => 'w-4 h-4','stroke' => 'currentColor','stroke-width' => '1.75']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $attributes = $__attributesOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__attributesOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a)): ?>
<?php $component = $__componentOriginal56804098dcf376a0e2227cb77b6cd00a; ?>
<?php unset($__componentOriginal56804098dcf376a0e2227cb77b6cd00a); ?>
<?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($value['subtext'])): ?>
                            <div class="flex-1">
                                <div class="dark:font-normal flex-1"><?php echo e(__($value['title'])); ?></div>
                                <?php if($value['subtext']): ?>
                                    <?php if($value['nav'] == 'comment'): ?>
                                        <div
                                            class="text-xs opacity-50 font-normal mt-1"><?php echo e(__($value['subtext'],['total' => short_number(\App\Models\Comment::where('status','draft')->count())])); ?></div>
                                    <?php elseif($value['nav'] == 'report'): ?>
                                        <div
                                            class="text-xs opacity-50 font-normal mt-1"><?php echo e(__($value['subtext'],['total' => short_number(\App\Models\Report::where('status','pending')->count())])); ?></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="flex-1 dark:font-normal"><?php echo e(__($value['title'])); ?></div>
                        <?php endif; ?>
                        <?php if(isset($value['menu'])): ?>
                            <svg class="text-gray-400 h-4 w-4 shrink-0" x-state:on="Expanded"
                                 x-state:off="Collapsed"
                                 :class="{ 'rotate-90 text-gray-500': selected === '<?php echo e($value['nav']); ?>', 'text-gray-400': !(open) }"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" x-transition>
                                <path fill-rule="evenodd"
                                      d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        <?php endif; ?>
                    </a>

                    <?php if(isset($value['menu'])): ?>
                        <ul class="overflow-hidden transition-[height] duration-1000" x-cloak=""
                            x-bind:class="selected === '<?php echo e($value['nav']); ?>' ? 'pt-2 pb-3 h-auto' : 'h-0'" x-transition>
                            <?php $__currentLoopData = $value['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subKey => $subValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="last:mb-0">
                                    <a class="px-4 py-1 text-xs text-gray-500/80 dark:text-gray-400/70 hover:text-gray-700 dark:hover:text-gray-300 flex gap-x-5 items-center"
                                       href="<?php if(Route::has($subKey)): ?><?php echo e(route($subKey)); ?><?php endif; ?>">
                                        <span
                                            class="ml-1 inline-flex h-1 w-1 rounded-full bg-current transition-all duration-200 opacity-40"></span>
                                        <span class="flex-1"><?php echo e(__($subValue['title'])); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</aside>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/admin/partials/sidenav.blade.php ENDPATH**/ ?>