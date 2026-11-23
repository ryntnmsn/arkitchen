<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';

type Subscription = { id: number; email: string; created_at: string };
defineProps<{ subscriptions: { data: Subscription[]; links: { url: string | null; label: string; active: boolean }[]; total: number } }>();

function removeSubscription(subscription: Subscription) {
    if (window.confirm(`Remove ${subscription.email} from the newsletter?`)) router.delete(`/admin/newsletter/${subscription.id}`);
}
</script>

<template>
    <Head title="Newsletter · Admin" />
    <div class="mb-4 flex items-center justify-between"><p class="text-sm text-slate-500">{{ subscriptions.total }} subscriber{{ subscriptions.total === 1 ? '' : 's' }}</p></div>
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div v-if="subscriptions.data.length" class="divide-y divide-slate-100">
            <div v-for="subscription in subscriptions.data" :key="subscription.id" class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div><p class="font-medium">{{ subscription.email }}</p><p class="mt-1 text-sm text-slate-500">Subscribed {{ new Date(subscription.created_at).toLocaleDateString() }}</p></div>
                <button class="self-start rounded-lg border border-red-200 px-3 py-2 text-sm text-red-700 hover:bg-red-50 sm:self-auto" @click="removeSubscription(subscription)">Remove</button>
            </div>
        </div>
        <p v-else class="px-6 py-12 text-center text-sm text-slate-500">No newsletter subscribers yet.</p>
        <div v-if="subscriptions.links.length > 3" class="flex flex-wrap gap-2 border-t border-slate-100 px-5 py-4"><a v-for="(link, index) in subscriptions.links" :key="index" :href="link.url || '#'" :class="['rounded-lg px-3 py-2 text-sm', link.active ? 'bg-slate-900 text-white' : 'border border-slate-200 text-slate-600', !link.url && 'pointer-events-none opacity-40']" v-html="link.label" /></div>
    </div>
</template>
