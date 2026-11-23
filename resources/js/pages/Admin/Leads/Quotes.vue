<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

type Attachment = { index: number; name: string };
type Lead = { id: number; name: string; phone: string; email: string; details: string; created_at: string; attachments: Attachment[] };
defineProps<{ requests: { data: Lead[]; links: { url: string | null; label: string; active: boolean }[] } }>();
</script>

<template>
    <Head title="Quote requests · Admin" />
    <div v-if="requests.data.length" class="grid gap-4">
        <article v-for="lead in requests.data" :key="lead.id" class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between"><div><h2 class="text-lg font-semibold">{{ lead.name }}</h2><p class="mt-1 text-xs text-slate-500">Request #{{ lead.id }} · {{ new Date(lead.created_at).toLocaleString() }}</p></div><div class="grid gap-1 text-sm"><a :href="`tel:${lead.phone}`" class="font-medium text-[#783d36]">{{ lead.phone }}</a><a :href="`mailto:${lead.email}`" class="text-slate-600">{{ lead.email }}</a></div></div>
            <p class="mt-5 border-t border-slate-100 pt-4 text-sm leading-6 whitespace-pre-line text-slate-700">{{ lead.details }}</p>
            <div v-if="lead.attachments.length" class="mt-4 flex flex-wrap gap-2"><a v-for="file in lead.attachments" :key="file.index" :href="`/admin/quote-requests/${lead.id}/attachments/${file.index}`" class="rounded-full border border-slate-200 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50">Download image {{ file.index + 1 }}</a></div>
        </article>
        <nav v-if="requests.links.length > 3" class="flex flex-wrap gap-2"><a v-for="(link, index) in requests.links" :key="index" :href="link.url || '#'" :class="['rounded-lg px-3 py-2 text-sm', link.active ? 'bg-slate-900 text-white' : 'border border-slate-200 text-slate-600', !link.url && 'pointer-events-none opacity-40']" v-html="link.label" /></nav>
    </div>
    <div v-else class="rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center text-sm text-slate-500">No quote requests yet.</div>
</template>
