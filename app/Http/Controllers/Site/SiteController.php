<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Content\BlogPosts;
use Illuminate\Http\Response as HttpResponse;
use Inertia\Inertia;
use Inertia\Response;

class SiteController extends Controller
{
    private const SERVICES = [
        'kitchen-cabinets' => ['name' => 'Kitchen Cabinets', 'keyword' => 'kitchen cabinet design Cebu', 'title' => 'Kitchen Cabinet Design in Cebu | A.R. Kitchen', 'description' => 'Plan kitchen cabinets in Cebu around your layout, storage needs, finish preferences, and everyday routine. Start with a free project quote. Begin here.', 'intro' => 'A well-planned kitchen cabinet layout makes everyday cooking feel more settled. Start with your room dimensions, the way you move through the kitchen, and the storage you reach for most.', 'details' => ['Plan storage around cooking zones, appliances, and the path between them.', 'Compare door styles, cabinet colors, and practical storage options before final measurements.', 'Share photos and rough dimensions to start a conversation about your Cebu kitchen.'], 'secondary' => ['modular kitchen cabinets Cebu', 'kitchen cabinet maker Cebu', 'custom kitchen storage']],
        'wardrobes' => ['name' => 'Wardrobes', 'keyword' => 'custom wardrobe Cebu', 'title' => 'Custom Wardrobe Design in Cebu | A.R. Kitchen', 'description' => 'Explore custom wardrobe layouts in Cebu with hanging space, shelves, drawers, and finishes planned around your room and routine. Make room for what matters.', 'intro' => 'A custom wardrobe can make better use of a bedroom wall when storage is planned around the clothes, linens, and daily items you actually keep there.', 'details' => ['Separate long-hang, short-hang, folded, and accessory storage.', 'Consider door swing or sliding doors alongside the available floor space.', 'Measure ceiling height, skirting, outlets, and nearby windows before detailed planning.'], 'secondary' => ['bedroom wardrobe cabinets Cebu', 'built-in wardrobe design', 'modular closet Cebu']],
        'walk-in-closets' => ['name' => 'Walk-in Closets', 'keyword' => 'walk-in closet design Cebu', 'title' => 'Walk-in Closet Design in Cebu | A.R. Kitchen', 'description' => 'Plan a walk-in closet in Cebu with clear circulation, useful hanging zones, shelves, drawers, and storage that fits the room. Start with a room brief.', 'intro' => 'A useful walk-in closet balances storage with enough room to move, open drawers, and reach what you need. Begin with the room shape and the clear walking space.', 'details' => ['Map the door, windows, and fixed obstructions first.', 'Group hanging, folded clothing, shoes, and accessories into reachable zones.', 'Leave room for doors and drawers to open without blocking the route through the closet.'], 'secondary' => ['walk-in wardrobe Cebu', 'closet cabinet maker Cebu', 'closet storage planning']],
        'vanity-cabinets' => ['name' => 'Vanity Cabinets', 'keyword' => 'bathroom vanity cabinet Cebu', 'title' => 'Bathroom Vanity Cabinets in Cebu | A.R. Kitchen', 'description' => 'Plan a bathroom vanity cabinet in Cebu around the basin, plumbing, daily essentials, available floor space, and finish preferences. Start with your space.', 'intro' => 'A vanity cabinet needs to work around the basin and plumbing while keeping daily essentials close. Room measurements and clear photos help establish a useful starting point.', 'details' => ['Record basin position, plumbing access, and the usable wall width.', 'Think about drawer access, cabinet doors, and where toiletries will go.', 'Discuss finish and care expectations for the actual bathroom environment.'], 'secondary' => ['bathroom cabinet design Cebu', 'vanity storage Cebu', 'custom bathroom cabinets']],
        'dresser-cabinets' => ['name' => 'Dresser Cabinets', 'keyword' => 'dresser cabinet Cebu', 'title' => 'Dresser Cabinet Design in Cebu | A.R. Kitchen', 'description' => 'Explore dresser cabinet layouts in Cebu with drawer sizes, useful top surfaces, and finishes planned for your bedroom space. Plan your storage needs first.', 'intro' => 'A dresser cabinet works best when drawer sizes match what you store and the top remains useful. Start with the wall, the items you need close by, and the room around it.', 'details' => ['Choose a mix of drawer heights for folded clothes and smaller items.', 'Check the clearance for drawers, doors, and walking paths.', 'Coordinate the cabinet finish with nearby wardrobes and bedroom furniture.'], 'secondary' => ['bedroom dresser Cebu', 'custom drawer cabinet', 'modular bedroom cabinets Cebu']],
    ];

    private const SERVICE_IMAGES = [
        'kitchen-cabinets' => [
            'image' => 'https://media.base44.com/images/public/6afd6cc97c9aaf3f1fbaef08/560af8568_generated_2e9ee8b6.png/v1/fill/w_356,h_267,al_c,q_90,usm_0.66_1.00_0.01,enc_auto,quality_auto/560af8568_generated_2e9ee8b6.png',
            'imageAlt' => 'Cream and oak modular kitchen cabinets with brass handles in a Cebu home',
        ],
        'wardrobes' => [
            'image' => 'https://media.base44.com/images/public/6afd6cc97c9aaf3f1fbaef08/c9567382d_generated_f1375af9.png/v1/fill/w_356,h_267,al_c,q_90,usm_0.66_1.00_0.01,enc_auto,quality_auto/c9567382d_generated_f1375af9.png',
            'imageAlt' => 'Built-in wardrobe with fluted oak doors and open shelving in a bedroom',
        ],
        'walk-in-closets' => [
            'image' => 'https://media.base44.com/images/public/6afd6cc97c9aaf3f1fbaef08/a7c67789a_generated_9600cf94.png/v1/fill/w_356,h_267,al_c,q_90,usm_0.66_1.00_0.01,enc_auto,quality_auto/a7c67789a_generated_9600cf94.png',
            'imageAlt' => 'Compact walk-in closet with oak shelving, hanging rail and a low drawer bank',
        ],
        'vanity-cabinets' => [
            'image' => 'https://media.base44.com/images/public/6afd6cc97c9aaf3f1fbaef08/2a1a19e9c_generated_1b48c3cc.png/v1/fill/w_356,h_267,al_c,q_90,usm_0.66_1.00_0.01,enc_auto,quality_auto/2a1a19e9c_generated_1b48c3cc.png',
            'imageAlt' => 'Floating oak bathroom vanity cabinet with two drawers and a round mirror',
        ],
        'dresser-cabinets' => [
            'image' => 'https://media.base44.com/images/public/6afd6cc97c9aaf3f1fbaef08/1599357a3_generated_e7cdc871.png/v1/fill/w_356,h_267,al_c,q_90,usm_0.66_1.00_0.01,enc_auto,quality_auto/1599357a3_generated_e7cdc871.png',
            'imageAlt' => 'Bedroom dresser cabinet in warm oak with fluted drawers and brass handles',
        ],
    ];

    private function seo(string $title, string $description, string $primary, array $secondary, string $path): array
    {
        return ['title' => $title, 'description' => $description, 'canonical' => 'https://www.arkitchencabinetdesign.com'.$path, 'primaryKeyword' => $primary, 'secondaryKeywords' => $secondary];
    }

    public function home(): Response
    {
        return Inertia::render('Site/Home', [
            'seo' => $this->seo('Kitchen Cabinet Design Cebu | A.R. Kitchen Cabinet Design', 'Plan modular kitchen cabinets, wardrobes, closets, and vanities with A.R. Kitchen Cabinet Design in Cebu and Central Visayas. Request a free project quote.', 'kitchen cabinet design Cebu', ['modular cabinets Cebu', 'custom wardrobes Cebu', 'cabinet maker Central Visayas'], '/'),
            'services' => collect(self::SERVICES)->map(fn ($item, $slug) => ['slug' => $slug, 'name' => $item['name'], 'keyword' => $item['keyword'], ...self::SERVICE_IMAGES[$slug]])->values(),
        ]);
    }

    public function sitemap(): HttpResponse
    {
        $urls = [
            '/', '/services', '/services/kitchen-cabinets', '/services/wardrobes',
            '/services/walk-in-closets', '/services/vanity-cabinets', '/services/dresser-cabinets',
            '/gallery', '/about', '/contact', '/design-your-cabinet', '/blog',
        ];
        $urls = array_merge($urls, array_map(fn (string $slug) => '/blog/'.$slug, array_keys(BlogPosts::all())));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach (array_unique($urls) as $path) {
            $xml .= '<url><loc>'.e('https://www.arkitchencabinetdesign.com'.$path).'</loc></url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function services(): Response
    {
        return Inertia::render('Site/Services', ['seo' => $this->seo('Cabinet Design Services in Cebu | A.R. Kitchen', 'Explore kitchen cabinets, wardrobes, walk-in closets, bathroom vanities, and dresser cabinets designed for homes in Cebu and Central Visayas. See your options.', 'cabinet design services Cebu', ['kitchen cabinets Cebu', 'wardrobe cabinets Cebu', 'vanity cabinets Cebu'], '/services'), 'services' => collect(self::SERVICES)->map(fn ($item, $slug) => ['slug' => $slug, ...$item, ...self::SERVICE_IMAGES[$slug]])->values()]);
    }

    public function service(string $slug): Response
    {
        $service = self::SERVICES[$slug] ?? abort(404);

        return Inertia::render('Site/Service', ['seo' => $this->seo($service['title'], $service['description'], $service['keyword'], $service['secondary'], '/services/'.$slug), 'service' => ['slug' => $slug, ...$service], 'otherServices' => collect(self::SERVICES)->except($slug)->map(fn ($item, $key) => ['slug' => $key, 'name' => $item['name']])->values()]);
    }

    public function gallery(): Response
    {
        return Inertia::render('Site/Gallery', ['seo' => $this->seo('Cabinet Design Gallery Cebu | A.R. Kitchen', 'Browse illustrative cabinet design studies for kitchens, wardrobes, closets, and vanities. Request a quote to discuss your own Cebu home. See your options.', 'cabinet design gallery Cebu', ['kitchen cabinet ideas Cebu', 'wardrobe design inspiration', 'modular cabinet styles'], '/gallery')]);
    }

    public function about(): Response
    {
        return Inertia::render('Site/About', ['seo' => $this->seo('About A.R. Kitchen Cabinet Design | Cebu', 'Learn about A.R. Kitchen Cabinet Design, a modular cabinet maker serving homeowners in Cebu and across Central Visayas. Read how to plan a project with us.', 'cabinet maker Cebu', ['modular cabinet maker Central Visayas', 'local cabinet design Cebu'], '/about')]);
    }

    public function contact(): Response
    {
        return Inertia::render('Site/Contact', ['seo' => $this->seo('Contact a Cabinet Maker in Cebu | Free Quote', 'Request a free cabinet project quote in Cebu. Share your name, phone, email, room details, and optional photos with A.R. Kitchen Cabinet Design. Talk with us.', 'cabinet quote Cebu', ['kitchen cabinet quote Cebu', 'cabinet installation quote Central Visayas'], '/contact')]);
    }

    public function designer(): Response
    {
        return Inertia::render('Site/Designer', ['seo' => $this->seo('AI Cabinet Design Preview Cebu | A.R. Kitchen', 'Build an AI-assisted cabinet brief for your Cebu home. Add dimensions, finish preferences, and room photos, then request a human review. Start with your room.', 'AI cabinet design Cebu', ['cabinet design preview Cebu', 'modular cabinet planner Central Visayas'], '/design-your-cabinet')]);
    }

    public function blog(): Response
    {
        $articles = collect(BlogPosts::all())->map(fn (array $article, string $slug) => [
            'slug' => $slug,
            'title' => $article['title'],
            'description' => $article['description'],
            'keyword' => $article['keyword'],
            'url' => '/blog/'.$slug,
            'image' => $article['image'],
            'imageAlt' => $article['imageAlt'],
        ])->values();

        return Inertia::render('Site/Blog/Index', [
            'seo' => $this->seo(
                'Cabinet Design Blog Cebu | A.R. Kitchen',
                'Read practical cabinet planning advice for Cebu homes, including modular vs custom cabinets, measuring, materials, storage, and questions to ask a cabinet maker.',
                'cabinet design blog Cebu',
                ['kitchen cabinet guide Cebu', 'wardrobe planning tips', 'modular cabinet ideas'],
                '/blog',
            ),
            'articles' => $articles,
        ]);
    }

    public function article(string $slug): Response
    {
        $article = BlogPosts::all()[$slug] ?? abort(404);

        return Inertia::render('Site/Blog/Show', [
            'seo' => $this->seo(
                $article['title'].' | A.R. Kitchen Cabinet Design Cebu',
                $article['description'],
                $article['keyword'],
                ['kitchen cabinet design Cebu', 'cabinet maker Cebu', 'cabinet planning tips'],
                '/blog/'.$slug,
            ),
            'article' => ['slug' => $slug, ...$article],
        ]);
    }
}
