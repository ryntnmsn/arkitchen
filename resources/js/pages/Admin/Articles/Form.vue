<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

type Article = { id: number; title: string; excerpt: string | null; content: string; published_at: string | null };
const props = defineProps<{ article: Article | null }>();
const title = props.article ? 'Edit article' : 'New article';
const form = useForm({
    title: props.article?.title ?? '',
    excerpt: props.article?.excerpt ?? '',
    content: props.article?.content ?? '',
    published: Boolean(props.article?.published_at),
});

function save() {
    if (props.article) form.put(`/admin/articles/${props.article.id}`);
    else form.post('/admin/articles');
}
</script>

<template>
    <Head :title="`${title} · Admin`" />
    <form class="space-y-5 rounded-2xl border border-slate-200 bg-white p-6" @submit.prevent="save">
        <div><label for="title" class="mb-2 block text-sm font-medium">Title</label><input id="title" v-model="form.title" required maxlength="255" class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-slate-500"><p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p></div>
        <div><label for="excerpt" class="mb-2 block text-sm font-medium">Short summary <span class="font-normal text-slate-400">(optional)</span></label><textarea id="excerpt" v-model="form.excerpt" rows="2" maxlength="500" class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-slate-500" /><p v-if="form.errors.excerpt" class="mt-1 text-sm text-red-600">{{ form.errors.excerpt }}</p></div>
        <div><label for="content" class="mb-2 block text-sm font-medium">Article content</label><textarea id="content" v-model="form.content" required rows="14" class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-slate-500" /><p v-if="form.errors.content" class="mt-1 text-sm text-red-600">{{ form.errors.content }}</p></div>
        <label class="flex items-center gap-2 text-sm"><input v-model="form.published" type="checkbox" class="rounded border-slate-300"> Publish this article</label>
        <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5"><button :disabled="form.processing" class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-700 disabled:opacity-60">{{ form.processing ? 'Saving…' : 'Save article' }}</button><Link href="/admin/articles" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-medium hover:bg-slate-50">Cancel</Link></div>
    </form>
</template>
