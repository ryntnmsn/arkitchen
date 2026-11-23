<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
type Seo = { title: string; description: string; canonical: string; primaryKeyword: string; secondaryKeywords: string[] };
defineProps<{ seo: Seo; articles: { slug: string; title: string; description: string; keyword: string; url: string; image: string; imageAlt: string }[] }>();
const blogSchema = {
    '@context': 'https://schema.org',
    '@type': 'Blog',
    name: 'A.R. Kitchen Cabinet Design Blog',
    url: 'https://www.arkitchencabinetdesign.com/blog',
    publisher: {
        '@type': 'Organization',
        name: 'A.R. Kitchen Cabinet Design',
        logo: {
            '@type': 'ImageObject',
            url: 'https://www.arkitchencabinetdesign.com/ar-kitchen-cabinet-logo.png',
        },
    },
};
</script>

<template>
    <Head :title="seo.title"><meta name="description" :content="seo.description"><meta name="keywords" :content="[seo.primaryKeyword, ...seo.secondaryKeywords].join(', ')"><link rel="canonical" :href="seo.canonical"><meta property="og:title" :content="seo.title"><meta property="og:description" :content="seo.description"><meta property="og:url" :content="seo.canonical"><meta property="og:type" content="website"><meta property="og:site_name" content="A.R. Kitchen Cabinet Design"><meta property="og:image" content="https://www.arkitchencabinetdesign.com/ar-kitchen-cabinet-logo.png"><meta name="twitter:card" content="summary"><component :is="'script'" type="application/ld+json" :innerHTML="JSON.stringify(blogSchema)" /></Head>
    <section class="bg-[#f2ebe3]"><div class="mx-auto max-w-7xl px-5 py-14 sm:py-20 lg:px-8"><p class="text-xs font-semibold tracking-[0.18em] text-[#9a594f] uppercase">A.R. Kitchen Cabinet Design</p><h1 class="mt-4 max-w-3xl text-4xl font-semibold tracking-tight sm:text-5xl">Cabinet design blog for Cebu homeowners.</h1><p class="mt-5 max-w-2xl text-base leading-7 text-[#6c635b]">Useful, locally relevant cabinet planning articles are on the way. Check back soon for the topics we are preparing for homeowners in Cebu and Central Visayas.</p></div></section>
    <section class="mx-auto max-w-7xl px-5 py-14 lg:px-8"><div v-if="articles.length" class="grid gap-5 md:grid-cols-2 lg:grid-cols-3"><article v-for="article in articles" :key="article.slug" class="flex flex-col overflow-hidden border border-[#e9e2da] bg-white"><Link :href="article.url" class="relative block"><img :src="article.image" :alt="article.imageAlt" class="aspect-video w-full object-cover" loading="lazy"><span class="absolute bottom-3 left-3 rounded-full bg-[#292521]/70 px-3 py-1.5 text-[10px] font-semibold tracking-wide text-white">KITCHEN CABINET</span></Link><div class="flex flex-1 flex-col p-6"><p class="text-xs font-semibold tracking-wide text-[#9a594f] uppercase">{{ article.keyword }}</p><h2 class="mt-3 text-xl leading-snug font-semibold"><Link :href="article.url" class="hover:text-[#783d36]">{{ article.title }}</Link></h2><p class="mt-3 flex-1 text-sm leading-6 text-[#716960]">{{ article.description }}</p><Link :href="article.url" class="mt-4 text-sm font-semibold text-[#783d36] underline decoration-[#c5a29a] underline-offset-4">Read the guide</Link></div></article></div>
        <div v-else class="border border-[#e9e2da] bg-white p-7 sm:p-9"><h2 class="text-2xl font-semibold">Articles are being prepared</h2><p class="mt-3 max-w-2xl text-sm leading-6 text-[#6c635b]">We will share practical guidance for planning cabinets at home. Have a project in mind? Tell us about it and request a free quote.</p><Link href="/contact" class="mt-5 inline-flex bg-[#783d36] px-5 py-3 text-sm font-semibold text-white">Request a free quote</Link></div>
    </section>
</template>
