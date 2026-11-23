<script setup lang="ts">
withDefaults(defineProps<{ finish?: string; compact?: boolean; label?: string }>(), {
    finish: 'warm-oak', compact: false, label: 'Illustrative modular cabinet concept',
});

const finishes: Record<string, { front: string; side: string; line: string; counter: string }> = {
    'warm-oak': { front: '#b9875d', side: '#8e6549', line: '#5e4031', counter: '#e9e2d7' },
    'soft-white': { front: '#eeeae2', side: '#d1c9bd', line: '#a49a8d', counter: '#f6f2ea' },
    'deep-walnut': { front: '#604337', side: '#392821', line: '#281d18', counter: '#e7ded3' },
    'earthy-red': { front: '#88463e', side: '#63302b', line: '#3e2522', counter: '#e9e1d7' },
};
</script>

<template>
    <svg :class="compact ? 'w-full' : 'w-full max-w-[620px]'" viewBox="0 0 640 490" role="img" :aria-label="label">
        <defs>
            <linearGradient id="room" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f8f1e7"/><stop offset="1" stop-color="#dfd3c5"/></linearGradient>
            <linearGradient id="floor" x1="0" y1="0" x2="1" y2="1"><stop stop-color="#d4c4b3"/><stop offset="1" stop-color="#b59f8b"/></linearGradient>
            <filter id="soft-shadow" x="-20%" y="-20%" width="150%" height="160%"><feDropShadow dx="0" dy="16" stdDeviation="12" flood-color="#43352a" flood-opacity=".18"/></filter>
        </defs>
        <rect x="0" y="0" width="640" height="490" rx="0" fill="url(#room)"/>
        <path d="M0 355 640 315v175H0z" fill="url(#floor)"/>
        <path d="M0 352 640 312" fill="none" stroke="#c2b09d" stroke-width="3"/>
        <rect x="54" y="52" width="135" height="167" rx="0" fill="#f4eee4"/>
        <rect x="66" y="64" width="111" height="143" rx="0" fill="#c5d1ce"/>
        <path d="M121 64v143M66 137h111" stroke="#f5f0e9" stroke-width="6"/>
        <path d="M66 64h111v143H66z" fill="none" stroke="#fff" stroke-width="10"/>
        <circle cx="161" cy="138" r="3" fill="#81786d"/>
        <ellipse cx="342" cy="403" rx="250" ry="35" fill="#594538" opacity=".16"/>
        <g filter="url(#soft-shadow)">
            <path d="M164 183 486 166l61 27-324 20z" :fill="finishes[finish]?.counter || finishes['warm-oak'].counter"/>
            <path d="M486 166 547 193v194l-61-20z" :fill="finishes[finish]?.side || finishes['warm-oak'].side"/>
            <path d="m223 213 324-20v194l-324 22z" :fill="finishes[finish]?.front || finishes['warm-oak'].front"/>
            <path d="m223 213 324-20v194l-324 22z" fill="none" :stroke="finishes[finish]?.line || finishes['warm-oak'].line" stroke-width="3"/>
            <path d="m223 213 324-20" stroke="#fff" stroke-opacity=".35" stroke-width="3"/>
            <g v-for="(x, index) in [237, 302, 367, 432, 497]" :key="x">
                <path :d="`M${x} ${212 - index * 4}v190`" fill="none" :stroke="finishes[finish]?.line || finishes['warm-oak'].line" stroke-opacity=".65" stroke-width="2"/>
                <path :d="`M${x + 8} ${270 - index * 4}v28`" stroke="#dfcbb0" stroke-width="4" stroke-linecap="round"/>
            </g>
            <path d="m223 327 324-20v81l-324 22z" fill="#342922" opacity=".12"/>
            <path d="m164 183 322-17 61 27-324 20z" fill="#faf8f3"/>
            <path d="m164 183 322-17 61 27-324 20z" fill="none" stroke="#d3c8ba" stroke-width="3"/>
            <path d="m283 187 60-4 38 14-60 4z" fill="#c8d6d2" stroke="#a9b7b3" stroke-width="2"/>
        </g>
        <path d="M108 418h425" stroke="#8c7763" stroke-opacity=".5" stroke-width="2"/>
        <g fill="#f9f7f3" opacity=".72"><circle cx="544" cy="81" r="34"/><circle cx="572" cy="105" r="18"/></g>
        <g transform="translate(28 448)">
            <rect width="154" height="26" rx="13" fill="#292521" fill-opacity=".68"/>
            <text x="77" y="17" text-anchor="middle" fill="#fff" font-size="12" font-family="Arial, sans-serif" font-weight="600" letter-spacing="1">KITCHEN CABINET</text>
        </g>
    </svg>
</template>
