<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
type Seo = { title: string; description: string; canonical: string; primaryKeyword: string; secondaryKeywords: string[] };
const props = defineProps<{ seo: Seo; article: { slug: string; title: string; description: string; keyword: string; date: string | null; intro: string | null; image: string; imageAlt: string; ctaHeadline?: string; ctaText?: string; ctaLinkLabel?: string; ctaPhone?: string; sections: { heading: string; paragraphs?: string[]; bullets?: string[] }[] } }>();
const structuredData = {
    '@context': 'https://schema.org', '@type': 'BlogPosting', headline: props.article.title,
    description: props.article.description,
    image: props.article.image,
    ...(props.article.date ? { datePublished: props.article.date } : {}),
    articleSection: props.article.sections.map((section) => section.heading),
    mainEntityOfPage: props.seo.canonical, author: { '@type': 'Organization', name: 'A.R. Kitchen Cabinet Design' },
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
    <Head :title="seo.title"><meta name="description" :content="seo.description"><meta name="keywords" :content="[seo.primaryKeyword, ...seo.secondaryKeywords].join(', ')"><link rel="canonical" :href="seo.canonical"><meta property="og:title" :content="seo.title"><meta property="og:description" :content="seo.description"><meta property="og:url" :content="seo.canonical"><meta property="og:type" content="article"><meta property="og:site_name" content="A.R. Kitchen Cabinet Design"><meta property="og:image" :content="article.image"><meta property="og:image:alt" :content="article.imageAlt"><meta name="twitter:card" content="summary_large_image"><meta name="twitter:image" :content="article.image"><component :is="'script'" type="application/ld+json" :innerHTML="JSON.stringify(structuredData)" /></Head>
    <article class="mx-auto max-w-4xl px-5 py-12 sm:py-16 lg:px-8"><Link href="/blog" class="text-sm font-semibold text-[#783d36] underline underline-offset-4">← All homeowner guides</Link><p class="mt-8 text-xs font-semibold tracking-[0.16em] text-[#9a594f] uppercase">{{ article.keyword }}<span v-if="article.date"> · {{ new Date(`${article.date}T00:00:00`).toLocaleDateString() }}</span></p><h1 class="mt-4 text-4xl leading-tight font-semibold tracking-tight sm:text-5xl">{{ article.title }}</h1><p class="mt-6 border-l-2 border-[#9a594f] pl-5 text-lg leading-8 text-[#625a52]">{{ article.intro || article.description }}</p><figure class="mt-8 overflow-hidden rounded-2xl"><div class="relative"><img :src="article.image" :alt="article.imageAlt" class="aspect-video w-full object-cover"><span class="absolute bottom-4 left-4 rounded-full bg-[#292521]/70 px-4 py-2 text-xs font-semibold tracking-wide text-white">KITCHEN CABINET</span></div><figcaption class="mt-2 text-sm text-[#766e66]">{{ article.imageAlt }}</figcaption></figure>
        <div v-if="article.content" class="mt-9 rounded-2xl border border-[#e9e2da] bg-white p-6 text-base leading-8 whitespace-pre-line text-[#504942]">{{ article.content }}</div>
        <div v-for="section in article.sections" :key="section.heading" class="mt-10"><h2 class="text-2xl font-semibold tracking-tight">{{ section.heading }}</h2><p v-for="paragraph in section.paragraphs" :key="paragraph" class="mt-4 text-base leading-8 text-[#504942]">{{ paragraph }}</p><ul v-if="section.bullets" class="mt-5 grid gap-3"> <li v-for="bullet in section.bullets" :key="bullet" class="flex gap-3 text-base leading-7 text-[#504942]"><span class="mt-1 text-[#9a594f]">•</span>{{ bullet }}</li></ul></div>
        <aside class="mt-12 rounded-3xl bg-[#efe8df] p-7 sm:p-9"><h2 class="text-2xl font-semibold">{{ article.ctaHeadline || 'Want to talk through your room?' }}</h2><p class="mt-3 text-sm leading-6 text-[#6c635b]">{{ article.ctaText || 'Share a few photos, rough measurements, and your storage priorities with A.R. Kitchen Cabinet Design.' }}</p><div class="mt-5 flex flex-wrap gap-3"><Link href="/contact" class="rounded-full bg-[#783d36] px-5 py-3 text-sm font-semibold text-white">{{ article.ctaLinkLabel || 'Request a free quote' }}</Link><a v-if="article.ctaPhone" href="tel:09652547644" class="rounded-full border border-[#cbbdb0] px-5 py-3 text-sm font-semibold text-[#453d37]">Call {{ article.ctaPhone }}</a><Link v-else href="/services" class="rounded-full border border-[#cbbdb0] px-5 py-3 text-sm font-semibold text-[#453d37]">Explore services</Link></div></aside>
    </article>
</template>
