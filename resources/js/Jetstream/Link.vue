<template>
    <inertia-link :href="href"
                  class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                  v-else>
        <slot></slot>
    </inertia-link>
</template>

<script>
export default {
    props: ['href']
}
</script>
