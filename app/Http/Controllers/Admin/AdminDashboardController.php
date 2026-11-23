<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\NewsletterSubscription;
use App\Models\QuoteRequest;
use App\Models\DesignRequest;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'articleCount' => Article::count(),
            'publishedArticleCount' => Article::whereNotNull('published_at')->count(),
            'subscriberCount' => NewsletterSubscription::count(),
            'quoteRequestCount' => QuoteRequest::count(),
            'designRequestCount' => DesignRequest::count(),
        ]);
    }
}
