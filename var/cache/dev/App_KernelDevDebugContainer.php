<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerYAkkO4p\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerYAkkO4p/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerYAkkO4p.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerYAkkO4p\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerYAkkO4p\App_KernelDevDebugContainer([
    'container.build_hash' => 'YAkkO4p',
    'container.build_id' => '231138bb',
    'container.build_time' => 1702584219,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerYAkkO4p');
