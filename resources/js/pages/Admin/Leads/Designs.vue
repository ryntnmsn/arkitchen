<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

type Attachment = { index: number; name: string };
type Brief = { id: number; name: string; phone: string; email: string; location: string; description: string; dimensions: string | null; style: string; color: string; status: string; created_at: string; conceptUrl: string | null; attachments: Attachment[] };
defineProps<{ requests: { data: Brief[]; links: { url: string | null; label: string; active: boolean }[] } }>();
</script>

<template>
    <Head title="Design requests · Admin" />
    <div v-if="requests.data.length" class="grid gap-4">
        <article v-for="brief in requests.data" :key="brief.id" class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between"><div><h2 class="text-lg font-semibold">{{ brief.name }} <span class="text-sm font-normal text-slate-500">· {{ brief.location }}</span></h2><p class="mt-1 text-xs text-slate-500">Request #{{ brief.id }} · {{ brief.status }} · {{ new Date(brief.created_at).toLocaleString() }}</p></div><div class="grid gap-1 text-sm"><a :href="`tel:${brief.phone}`" class="font-medium text-[#783d36]">{{ brief.phone }}</a><a :href="`mailto:${brief.email}`" class="text-slate-600">{{ brief.email }}</a></div></div>
            <div class="mt-5 grid gap-4 border-t border-slate-100 pt-4 sm:grid-cols-3"><div><p class="text-xs font-semibold text-slate-400 uppercase">Style</p><p class="mt-1 text-sm">{{ brief.style.replaceAll('-', ' ') }}</p></div><div><p class="text-xs font-semibold text-slate-400 uppercase">Finish direction</p><p class="mt-1 text-sm">{{ brief.color.replaceAll('-', ' ') }}</p></div><div><p class="text-xs font-semibold text-slate-400 uppercase">Approx. dimensions</p><p class="mt-1 text-sm">{{ brief.dimensions || 'Not provided' }}</p></div></div>
            <p class="mt-4 text-sm leading-6 whitespace-pre-line text-slate-700">{{ brief.description }}</p>
            <div v-if="brief.attachments.length || brief.conceptUrl" class="mt-4 flex flex-wrap gap-2"><a v-for="file in brief.attachments" :key="file.index" :href="`/admin/design-requests/${brief.id}/attachments/${file.index}`" class="rounded-full border border-slate-200 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50">Download reference {{ file.index + 1 }}</a><a v-if="brief.conceptUrl" :href="brief.conceptUrl" target="_blank" rel="noreferrer" class="rounded-full border border-[#cdb3ac] px-3 py-2 text-xs font-medium text-[#783d36] hover:bg-[#faf4f1]">View AI concept</a></div>
        </article>
        <nav v-if="requests.links.length > 3" class="flex flex-wrap gap-2"><a v-for="(link, index) in requests.links" :key="index" :href="link.url || '#'" :class="['rounded-lg px-3 py-2 text-sm', link.active ? 'bg-slate-900 text-white' : 'border border-slate-200 text-slate-600', !link.url && 'pointer-events-none opacity-40']" v-html="link.label" /></nav>
    </div>
    <div v-else class="rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center text-sm text-slate-500">No design requests yet.</div>
</template>
