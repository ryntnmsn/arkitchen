<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import CabinetScene from '@/components/CabinetScene.vue';
import { computed } from 'vue';
type Seo = { title: string; description: string; canonical: string; primaryKeyword: string; secondaryKeywords: string[] };
const props = defineProps<{ seo: Seo; service: { name: string; keyword: string; intro: string; details: string[]; secondary: string[] }; otherServices: { slug: string; name: string }[] }>();
const headline = computed(() => ({
    'kitchen cabinet design Cebu': 'Kitchen cabinet design in Cebu, planned around your room.',
    'custom wardrobe Cebu': 'Custom wardrobe design in Cebu, shaped around your space.',
    'walk-in closet design Cebu': 'Walk-in closet design in Cebu, with room to move.',
    'bathroom vanity cabinet Cebu': 'Bathroom vanity cabinets in Cebu, planned for daily use.',
    'dresser cabinet Cebu': 'Dresser cabinets in Cebu, planned around your storage.',
}[props.service.keyword] ?? `${props.service.name} design in Cebu`));
const serviceSchema = {
    '@context': 'https://schema.org',
    '@type': 'Service',
    name: `${props.service.name} in Cebu`,
    serviceType: props.service.name,
    areaServed: ['Cebu', 'Central Visayas'],
    provider: { '@type': 'Organization', name: 'A.R. Kitchen Cabinet Design', url: 'https://www.arkitchencabinetdesign.com/' },
};
</script>

<template>
    <Head :title="seo.title"><meta name="description" :content="seo.description"><meta name="keywords" :content="[seo.primaryKeyword, ...seo.secondaryKeywords].join(', ')"><link rel="canonical" :href="seo.canonical"><component :is="'script'" type="application/ld+json" :innerHTML="JSON.stringify(serviceSchema)" /></Head>
    <section class="bg-[#f2ebe3]"><div class="mx-auto grid max-w-7xl gap-8 px-5 py-14 lg:grid-cols-[1fr_.8fr] lg:items-center lg:px-8 lg:py-20"><div><p class="text-xs font-semibold tracking-[0.18em] text-[#9a594f] uppercase">{{ service.keyword }} · A.R. Kitchen Cabinet Design</p><h1 class="mt-4 max-w-2xl text-4xl font-semibold tracking-tight sm:text-5xl">{{ headline }}</h1><p class="mt-5 max-w-2xl text-base leading-7 text-[#6c635b]">{{ service.intro }}</p><Link href="/contact" class="mt-7 inline-flex rounded-full bg-[#783d36] px-6 py-3.5 text-sm font-semibold text-white hover:bg-[#5f2e29]">Request a free quote</Link></div><div class="rounded-3xl border border-white/60 bg-white/50 p-3"><CabinetScene finish="warm-oak" :label="`Illustrative ${service.name.toLowerCase()} cabinet design concept, not a completed project photo`"/></div></div></section>
    <section class="mx-auto grid max-w-7xl gap-10 px-5 py-16 lg:grid-cols-[1fr_.7fr] lg:px-8"><div><p class="text-xs font-semibold tracking-[0.18em] text-[#9a594f] uppercase">Plan for the way you live</p><h2 class="mt-3 text-3xl font-semibold">Useful details to think through</h2><ul class="mt-6 grid gap-4"> <li v-for="(detail, index) in service.details" :key="detail" class="flex gap-4 rounded-2xl border border-[#e9e2da] bg-white p-5"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#f5ebe6] text-sm font-semibold text-[#783d36]">{{ index + 1 }}</span><p class="pt-1 text-sm leading-6 text-[#625a52]">{{ detail }}</p></li></ul><p class="mt-6 text-sm leading-6 text-[#766e66]">Use the <Link href="/design-your-cabinet" class="font-semibold text-[#783d36] underline underline-offset-4">cabinet concept preview</Link> to organize your style ideas, or go straight to the <Link href="/contact" class="font-semibold text-[#783d36] underline underline-offset-4">quote request form</Link>.</p></div><aside class="h-fit rounded-3xl bg-[#efe8df] p-6 sm:p-8"><p class="text-xs font-semibold tracking-[0.16em] text-[#9a594f] uppercase">Start with a simple brief</p><h2 class="mt-3 text-2xl font-semibold">A photo can help us understand the space.</h2><p class="mt-3 text-sm leading-6 text-[#6c635b]">Share the room, what you want to store, and any finish references you like. Approximate measurements are helpful; exact sizes should be checked on site before a build.</p><a href="tel:09652547644" class="mt-6 block font-semibold text-[#783d36]">Call 0965 254 7644</a><Link href="/contact" class="mt-5 inline-flex rounded-full bg-[#783d36] px-5 py-3 text-sm font-semibold text-white">Ask for a quote</Link></aside></section>
    <section class="border-y border-[#e8e0d7] bg-white"><div class="mx-auto max-w-7xl px-5 py-12 lg:px-8"><h2 class="text-2xl font-semibold">Explore other cabinet services</h2><div class="mt-5 flex flex-wrap gap-3"><Link v-for="other in otherServices" :key="other.slug" :href="`/services/${other.slug}`" class="rounded-full border border-[#e4dbd1] px-4 py-2.5 text-sm font-medium text-[#625a52] hover:border-[#b9948c] hover:text-[#783d36]">{{ other.name }}</Link></div></div></section>
</template>
