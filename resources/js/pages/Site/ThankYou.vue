<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Seo = { title: string; description: string; canonical: string; primaryKeyword: string; secondaryKeywords: string[] };
defineProps<{ seo: Seo }>();
</script>

<template>
    <Head :title="seo.title">
        <meta name="description" :content="seo.description">
        <link rel="canonical" :href="seo.canonical">
    </Head>

    <section class="mx-auto max-w-3xl px-5 py-20 text-center sm:py-28">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-3xl text-emerald-700" aria-hidden="true">✓</div>
        <p class="mt-6 text-xs font-semibold tracking-[0.18em] text-[#9a594f] uppercase">Request sent</p>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight sm:text-5xl">Thank you for getting in touch.</h1>
        <p class="mx-auto mt-5 max-w-xl text-base leading-7 text-[#6c635b]">We’ve received your cabinet project details and will follow up using the contact information you provided.</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <Link href="/" class="rounded-full bg-[#783d36] px-6 py-3.5 text-sm font-semibold text-white">Back to home</Link>
            <a href="tel:09652547644" class="rounded-full border border-[#d8cec4] px-6 py-3.5 text-sm font-semibold text-[#5d4d43]">Call 0965 254 7644</a>
        </div>
    </section>
</template>
