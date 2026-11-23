<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const menuOpen = ref(false);
const newsletter = useForm({ email: '' });
const navItems = [
    { label: 'Services', href: '/services' },
    { label: 'Gallery', href: '/gallery' },
    { label: 'About', href: '/about' },
    { label: 'Blogs', href: '/blog' },
    { label: 'Contact', href: '/contact' },
];
const companySchema = {
    '@context': 'https://schema.org',
    '@type': 'Organization',
    name: 'A.R. Kitchen Cabinet Design',
    url: 'https://www.arkitchencabinetdesign.com/',
    logo: 'https://www.arkitchencabinetdesign.com/ar-kitchen-cabinet-logo.png',
    email: 'admin@arkitchencabinetdesign.com',
    telephone: '+639652547644',
    areaServed: ['Cebu', 'Central Visayas'],
    sameAs: ['https://www.facebook.com/modularcabinetcebu'],
};
const success = computed(() => page.props.flash?.success as string | undefined);
</script>

<template>
    <Head>
        <component :is="'script'" type="application/ld+json" :innerHTML="JSON.stringify(companySchema)" />
    </Head>
    <div class="site-shell min-h-screen bg-[#fbfaf7] text-[#292521]">
        <div class="bg-[#6f332d] px-4 py-2 text-center text-xs font-medium tracking-wide text-white sm:text-sm">
            Modular cabinet design for Cebu and Central Visayas <span class="mx-2 text-white/50">·</span> <a href="tel:09652547644" class="underline decoration-white/50 underline-offset-2">Call 0965 254 7644</a>
        </div>
        <header class="sticky top-0 z-40 border-b border-[#e8e2db] bg-[#fbfaf7]/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
                <Link href="/" class="group flex items-center gap-3" aria-label="A.R. Kitchen Cabinet Design home">
                    <img src="/ar-kitchen-cabinet-logo.png" alt="A.R. Kitchen Cabinet Design" class="h-11 w-auto object-contain" />
                </Link>
                <nav class="hidden items-center gap-7 lg:flex" aria-label="Main navigation">
                    <Link v-for="item in navItems" :key="item.href" :href="item.href" class="text-sm font-medium text-[#625c55] transition hover:text-[#783d36]">{{ item.label }}</Link>
                    <Link href="/design-your-cabinet" class="text-sm font-medium text-[#783d36] hover:text-[#552821]">Design preview</Link>
                </nav>
                <Link href="/contact" class="hidden rounded-full bg-[#783d36] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#5f2e29] lg:inline-flex">Request a free quote</Link>
                <button class="rounded-xl border border-[#e5ddd4] px-3 py-2 text-sm font-medium lg:hidden" :aria-expanded="menuOpen" aria-label="Toggle navigation" @click="menuOpen = !menuOpen">{{ menuOpen ? 'Close' : 'Menu' }}</button>
            </div>
            <nav v-if="menuOpen" class="border-t border-[#e8e2db] bg-[#fbfaf7] px-5 py-3 lg:hidden" aria-label="Mobile navigation">
                <Link v-for="item in navItems" :key="item.href" :href="item.href" class="block rounded-lg px-3 py-3 text-sm font-medium" @click="menuOpen = false">{{ item.label }}</Link>
                <Link href="/design-your-cabinet" class="block rounded-lg px-3 py-3 text-sm font-semibold text-[#783d36]" @click="menuOpen = false">AI cabinet concept preview</Link>
                <Link href="/contact" class="mt-2 block rounded-lg bg-[#783d36] px-3 py-3 text-center text-sm font-semibold text-white" @click="menuOpen = false">Request a free quote</Link>
            </nav>
        </header>

        <div v-if="success" class="mx-auto mt-4 max-w-7xl px-5 lg:px-8"><div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">{{ success }}</div></div>
        <main><slot /></main>

        <footer class="mt-20 bg-[#292521] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-5 py-14 md:grid-cols-2 lg:grid-cols-[1.1fr_1fr_1fr_1.2fr] lg:px-8">
                <div>
                    <Link href="/" class="inline-flex items-center"><img src="/ar-kitchen-cabinet-logo.png" alt="A.R. Kitchen Cabinet Design" class="h-11 w-auto object-contain brightness-0 invert" /></Link>
                    <p class="mt-4 max-w-xs text-sm leading-6 text-white/65">Modular cabinet design for kitchens, wardrobes, closets, vanities, and dressers in Cebu and Central Visayas.</p>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-white/45 uppercase">Explore</h2>
                    <div class="mt-4 grid gap-3 text-sm text-white/80">
                        <Link href="/services" class="hover:text-white">Cabinet services</Link><Link href="/gallery" class="hover:text-white">Design gallery</Link><Link href="/about" class="hover:text-white">About the team</Link><Link href="/blog" class="hover:text-white">Homeowner guides</Link><Link href="/design-your-cabinet" class="hover:text-white">AI cabinet preview</Link>
                    </div>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-white/45 uppercase">Talk through your project</h2>
                    <div class="mt-4 grid gap-3 text-sm text-white/80">
                        <a href="tel:09652547644" class="hover:text-white">0965 254 7644</a><a href="mailto:admin@arkitchencabinetdesign.com" class="break-all hover:text-white">admin@arkitchencabinetdesign.com</a><a href="https://www.facebook.com/modularcabinetcebu" target="_blank" rel="noreferrer" class="hover:text-white">Facebook · modularcabinetcebu</a><span>LinkedIn · A.R. Kitchen Cabinet Design</span><Link href="/contact#map" class="hover:text-white">Find us on Google Maps</Link>
                    </div>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-white/45 uppercase">A little cabinet inspiration</h2>
                    <p class="mt-4 text-sm leading-6 text-white/65">Occasional planning ideas for making your home work better.</p>
                    <form class="mt-4 flex gap-2" @submit.prevent="newsletter.post('/newsletter/subscribe')">
                        <label class="sr-only" for="footer-newsletter-email">Email address</label><input id="footer-newsletter-email" v-model="newsletter.email" type="email" required placeholder="Email address" class="min-w-0 flex-1 rounded-lg border border-white/20 bg-white/10 px-3 py-2.5 text-sm text-white placeholder:text-white/45 focus:border-white/60 focus:outline-none">
                        <button aria-label="Subscribe to the newsletter" class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#292521] hover:bg-[#f3ede5]">Join</button>
                    </form>
                    <p v-if="newsletter.errors.email" class="mt-2 text-xs text-red-300">{{ newsletter.errors.email }}</p>
                </div>
            </div>
            <div class="border-t border-white/10"><div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-5 text-xs text-white/45 sm:flex-row sm:items-center sm:justify-between lg:px-8"><span>© {{ new Date().getFullYear() }} A.R. Kitchen Cabinet Design</span><span>Serving Cebu and Central Visayas</span></div></div>
        </footer>
        <Link href="/contact" class="fixed right-4 bottom-4 z-50 rounded-full bg-[#783d36] px-5 py-3 text-sm font-semibold text-white shadow-xl shadow-[#391c18]/20 sm:right-6 sm:bottom-6">Request a free quote </Link>
    </div>
</template>

<style>
.site-shell * {
    border-radius: 0 !important;
}

.site-shell ::file-selector-button {
    border-radius: 0 !important;
}

.site-shell h1,
.site-shell h2,
.site-shell h3,
.site-shell h4,
.site-shell h5,
.site-shell h6 {
    font-family: Georgia, 'Times New Roman', serif;
}
</style>
