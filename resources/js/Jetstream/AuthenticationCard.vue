<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-dark">
        <div style="z-index: 3;">
            <slot name="logo" />
        </div>

        <div class="w-11/12 sm:max-w-md mt-6 px-6 py-4 bg-blue-light shadow-md overflow-hidden sm:rounded-lg" style="z-index: 3">
            <slot />
        </div>
    </div>
</template>
