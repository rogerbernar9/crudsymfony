<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXKcR3OJ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXKcR3OJ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXKcR3OJ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXKcR3OJ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerXKcR3OJ\srcApp_KernelDevDebugContainer(array(
    'container.build_hash' => 'XKcR3OJ',
    'container.build_id' => 'a07caaf1',
    'container.build_time' => 1545401044,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerXKcR3OJ');
