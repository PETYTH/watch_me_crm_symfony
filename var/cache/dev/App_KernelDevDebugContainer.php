<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerLZECbs3\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerLZECbs3/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerLZECbs3.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerLZECbs3\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerLZECbs3\App_KernelDevDebugContainer([
    'container.build_hash' => 'LZECbs3',
    'container.build_id' => '5b5e0f98',
    'container.build_time' => 1700782533,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerLZECbs3');
