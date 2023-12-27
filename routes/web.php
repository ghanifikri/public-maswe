<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AboutKaliganduController;
use App\Http\Controllers\Admin\AboutMasweController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ChangeFontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FasilitasProduksiController;
use App\Http\Controllers\Admin\FounderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeaderVideoController;
use App\Http\Controllers\Admin\KapasitasProduksiController;
use App\Http\Controllers\Admin\News\CategoryController;
use App\Http\Controllers\Admin\News\PostController;
use App\Http\Controllers\Admin\News\TitleController;
use App\Http\Controllers\Admin\SectionHeroController;
use App\Http\Controllers\Admin\LongHistoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PeopleController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionHeaderController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\GalleryController as ControllersGalleryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResearchController as ControllersResearchController;
use App\Http\Controllers\user\DashboardController as UserDashboardController;
use App\Http\Controllers\user\ReviewController;
use App\Http\Controllers\user\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* -------------------------------------------------------------------------- */
/*                               Login socialite                              */
/* -------------------------------------------------------------------------- */
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

Route::get('/login', [LoginController::class, 'index'])->name('frontend.login')->middleware('guest');
Route::get('/register/user', [LoginController::class, 'register'])->name('frontend.register')->middleware('guest');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'AboutUs'], function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/values', [ValuesController::class, 'index'])->name('values');
    Route::get('/field', [FieldController::class, 'index'])->name('field');
    Route::get('/field/show/{id}', [FieldController::class, 'show']);
    Route::get('/research', [ControllersResearchController::class, 'index'])->name('research');
});
Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::get('/produk/detail/{slug}', [ProductController::class, 'detail'])->name('produk.detail');
Route::post('/product/{slug}/review', [ProductReviewsController::class, 'store'])->name('review.store');

/* -------------------------------------------------------------------------- */
/*                                 Add to cart                                */
/* -------------------------------------------------------------------------- */
Route::post('/produk/cart', [CartController::class, 'store'])->name('add-to-cart')->middleware(['auth', 'CekRole:user']);
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::delete('/cart-delete/{id}', [CartController::class, 'destroy'])->name('cart-delete');
Route::post('/cart-update', [CartController::class, 'cartUpdate'])->name('cart-update');
Route::post('/checkout', [CheckOutController::class, 'process'])->name('checkout');

/* -------------------------------------------------------------------------- */
/*                          Payment gateway midtrans                          */
/* -------------------------------------------------------------------------- */
Route::get('payment/success', [CheckOutController::class, 'midtransCallback']);
Route::post('payment/success', [CheckOutController::class, 'midtransCallback']);

/* -------------------------------------------------------------------------- */
/*                               User dashboard                               */
/* -------------------------------------------------------------------------- */
Route::group(['prefix' => 'myDashboard', 'middleware' => ['user', 'CekRole:user']], function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('myDashboard');
    Route::get('/userTransaction', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::get('/reviews/edit/{id}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/update/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('reviews.delete');
    Route::get('/myProfile/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/myProfile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
});


/* ------------------------------ Route Success ----------------------------- */
Route::get('/success', [CartController::class, 'success'])->name('success');

/* --------------------------------- Gallery -------------------------------- */
Route::get('/gallery', [ControllersGalleryController::class, 'index'])->name('gallery');

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'index'])->name('news');
    Route::get('/category/{slug}', [NewsController::class, 'category'])->name('news.category');
    Route::get('/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('/show/{slug}', [NewsController::class, 'show'])->name('news.show');
});

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak/post', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/kontak/show/{id}', [KontakController::class, 'show'])->name('kontak.show');
Route::get('/kontak/five', [KontakController::class, 'messageVife'])->name('kontak.messageVife');

/* -------------------------------------------------------------------------- */
/*                              Admin Route Group                             */
/* -------------------------------------------------------------------------- */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'CekRole:admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'header-video'], function () {
        Route::get('/', [HeaderVideoController::class, 'index'])->name('header-video.index');
        Route::post('/store', [HeaderVideoController::class, 'store'])->name('header-video.store');
        Route::get('/edit/{header_video}', [HeaderVideoController::class, 'edit'])->name('header-video.edit');
        Route::put('/update/{header_video}', [HeaderVideoController::class, 'update'])->name('header-video.update');
        Route::get('/change-font', [ChangeFontController::class, 'headerVideo'])->name('change-font.headerVideo');
        Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.store');
    });

    Route::group(['prefix' => 'abouts'], function () {
        Route::get('/', [AboutController::class, 'index'])->name('about.index');
        Route::post('/store', [AboutController::class, 'store'])->name('about.store');
        Route::get('/edit/{about}', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('update/{about}', [AboutController::class, 'update'])->name('about.update');
        Route::get('/change-font', [ChangeFontController::class, 'about'])->name('change-font.about');
        Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeAbout');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::group(['prefix' => 'title'], function () {
            Route::get('/', [TitleController::class, 'index'])->name('title.index');
            Route::post('/store', [TitleController::class, 'store'])->name('title.store');
            Route::get('/edit/{id}', [TitleController::class, 'edit'])->name('title.edit');
            Route::put('update/{id}', [TitleController::class, 'update'])->name('title.update');
            Route::get('/change-font', [ChangeFontController::class, 'titleNews'])->name('change-font.titleNews');
            Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleNews');
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('/change-font', [ChangeFontController::class, 'titleCategory'])->name('change-font.titleCategory');
            Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleCategory');
        });
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::get('/create', [PostController::class, 'create'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->name('post.store');
            Route::get('/show/{post}', [PostController::class, 'show'])->name('post.show');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('post.update');
            Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
            Route::get('/change-font', [ChangeFontController::class, 'titlePost'])->name('change-font.titlePost');
            Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitlePost');
        });
    });

    Route::group(['prefix' => 'area'], function () {
        route::get('/', [AboutKaliganduController::class, 'index'])->name('aboutKaligandu.index');
        route::post('/post', [AboutKaliganduController::class, 'store'])->name('aboutKaligandu.store');
        route::get('/edit/{id}', [AboutKaliganduController::class, 'edit'])->name('aboutKaligandu.edit');
        route::put('/update/{id}', [AboutKaliganduController::class, 'update'])->name('aboutKaligandu.update');
        Route::get('/chenge-font', [ChangeFontController::class, 'titleArea'])->name('change-font.titleArea');
        Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleArea');
    });

    Route::group(['prefix' => 'aboutPage'], function () {
        Route::group(['prefix' => 'history'], function () {
            route::group(['prefix' => 'heroSection'], function () {
                Route::get('/', [SectionHeroController::class, 'history'])->name('heroHistory.index');
                Route::post('/store', [SectionHeroController::class, 'store'])->name('heroHistory.store');
                Route::get('/edit/{id}', [SectionHeroController::class, 'editHeroHistory'])->name('heroHistory.edit');
                Route::put('/update/{id}', [SectionHeroController::class, 'update'])->name('heroHistory.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'titleHeroAboutPage'])->name('change-font.titleHeroAbout');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeroAbout');
            });
            Route::group(['prefix' => 'aboutMaswe'], function () {
                route::get('/', [AboutMasweController::class, 'index'])->name('aboutMaswe.index');
                route::post('/post', [AboutMasweController::class, 'store'])->name('aboutMaswe.store');
                route::get('/edit/{id}', [AboutMasweController::class, 'edit'])->name('aboutMaswe.edit');
                route::put('/update/{id}', [AboutMasweController::class, 'update'])->name('aboutMaswe.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'titleAboutMaswe'])->name('change-font.titleAboutMaswe');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleAboutMaswe');
            });
            Route::group(['prefix' => 'longHistories'], function () {
                Route::get('/', [LongHistoryController::class, 'index'])->name('longHistory.index');
                Route::get('/create', [LongHistoryController::class, 'create'])->name('longHistory.create');
                Route::post('/store', [LongHistoryController::class, 'store'])->name('longHistory.store');
                Route::get('/edit/{longHistory}', [LongHistoryController::class, 'edit'])->name('longHistory.edit');
                Route::put('/update/{longHistory}', [LongHistoryController::class, 'update'])->name('longHistory.update');
                Route::delete('/delete/{id}', [LongHistoryController::class, 'destroy'])->name('longHistory.destroy');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontLongHistories'])->name('change-font.titleLongHistories');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleLongHistories');
            });
        });
        Route::group(['prefix' => 'valuesAndPeople'], function () {
            route::group(['prefix' => 'heroSection'], function () {
                Route::get('/', [SectionHeroController::class, 'valuesPeople'])->name('valuesPeople.index');
                Route::post('/store', [SectionHeroController::class, 'store'])->name('valuesPeople.store');
                Route::get('/edit/{id}', [SectionHeroController::class, 'editValuesPeople'])->name('valuesPeople.edit');
                Route::put('/update/{id}', [SectionHeroController::class, 'update'])->name('valuesPeople.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontHeroValues'])->name('change-font.titleHeroValues');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeroValuess');
            });
            Route::group(['prefix' => 'sectionHeader'], function () {
                Route::get('/', [SectionHeaderController::class, 'valuesPeople'])->name('headerPeople.index');
                Route::post('/store', [SectionHeaderController::class, 'store'])->name('headerPeople.store');
                Route::get('/edit/{id}', [SectionHeaderController::class, 'editValuesPeople'])->name('headerPeople.edit');
                Route::put('/update/{id}', [SectionHeaderController::class, 'update'])->name('headerPeople.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontHeaderValues'])->name('change-font.titleHeaderValues');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeaderValuess');
            });
            Route::group(['prefix' => 'founder'], function () {
                Route::get('/', [FounderController::class, 'index'])->name('founder.index');
                Route::get('/create', [FounderController::class, 'create'])->name('founder.create');
                Route::post('/store', [FounderController::class, 'store'])->name('founder.store');
                Route::get('/edit/{founder}', [FounderController::class, 'edit'])->name('founder.edit');
                Route::put('/update/{founder}', [FounderController::class, 'update'])->name('founder.update');
                Route::delete('/delete/{id}', [FounderController::class, 'destroy'])->name('founder.destroy');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontFounderPeople'])->name('change-font.titleFounderPeople');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleFounderPeople');
            });
            Route::group(['prefix' => 'people'], function () {
                Route::get('/', [PeopleController::class, 'index'])->name('people.index');
                Route::get('/create', [PeopleController::class, 'create'])->name('people.create');
                Route::post('/store', [PeopleController::class, 'store'])->name('people.store');
                Route::get('/edit/{people}', [PeopleController::class, 'edit'])->name('people.edit');
                Route::put('/update/{people}', [PeopleController::class, 'update'])->name('people.update');
                Route::delete('/delete/{id}', [PeopleController::class, 'destroy'])->name('people.destroy');
            });
        });
        Route::group(['prefix' => 'field'], function () {
            route::group(['prefix' => 'heroSection'], function () {
                Route::get('/', [SectionHeroController::class, 'field'])->name('heroField.index');
                Route::post('/store', [SectionHeroController::class, 'store'])->name('heroField.store');
                Route::get('/edit/{id}', [SectionHeroController::class, 'editField'])->name('heroField.edit');
                Route::put('/update/{id}', [SectionHeroController::class, 'update'])->name('heroField.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontHeroField'])->name('change-font.titleHeroField');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeroField');
            });
            Route::group(['prefix' => 'sectionHeaderFasilitas'], function () {
                Route::get('/', [SectionHeaderController::class, 'fieldFasilitas'])->name('headerFieldFasilitas.index');
                Route::post('/store', [SectionHeaderController::class, 'store'])->name('headerFieldFasilitas.store');
                Route::get('/edit/{id}', [SectionHeaderController::class, 'editFieldFasilitas'])->name('headerFieldFasilitas.edit');
                Route::put('/update/{id}', [SectionHeaderController::class, 'update'])->name('headerFieldFasilitas.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontHeaderField'])->name('change-font.titleHeaderField');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeaderField');
            });
            Route::group(['prefix' => 'sectionHeaderTeam'], function () {
                Route::get('/', [SectionHeaderController::class, 'fieldTeam'])->name('headerTeam.index');
                Route::post('/store', [SectionHeaderController::class, 'store'])->name('headerTeam.store');
                Route::get('/edit/{id}', [SectionHeaderController::class, 'editFieldTeam'])->name('headerTeam.edit');
                Route::put('/update/{id}', [SectionHeaderController::class, 'update'])->name('headerTeam.update');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontHeaderTeam'])->name('change-font.titleHeaderTeam');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleHeaderTeam');
            });
            Route::group(['prefix' => 'fasilitasProduksi'], function () {
                Route::get('/', [FasilitasProduksiController::class, 'index'])->name('fasilitasProduksi.index');
                Route::get('/create', [FasilitasProduksiController::class, 'create'])->name('fasilitasProduksi.create');
                Route::post('/store', [FasilitasProduksiController::class, 'store'])->name('fasilitasProduksi.store');
                Route::get('/edit/{fasilitasProduksi}', [FasilitasProduksiController::class, 'edit'])->name('fasilitasProduksi.edit');
                Route::put('/update/{fasilitasProduksi}', [FasilitasProduksiController::class, 'update'])->name('fasilitasProduksi.update');
                Route::delete('/delete/{id}', [FasilitasProduksiController::class, 'destroy'])->name('fasilitasProduksi.destroy');
                Route::get('/chenge-font', [ChangeFontController::class, 'fontFasilitasProduksi'])->name('change-font.titleFasilitasProduksi');
                Route::post('/font', [ChangeFontController::class, 'storeFont'])->name('changeFont.storeTitleFasilitasProduksi');
            });
            Route::group(['prefix' => 'kapasitasProduksi'], function () {
                Route::get('/', [KapasitasProduksiController::class, 'index'])->name('kapasitasProduksi.index');
                Route::get('/create', [KapasitasProduksiController::class, 'create'])->name('kapasitasProduksi.create');
                Route::post('/store', [KapasitasProduksiController::class, 'store'])->name('kapasitasProduksi.store');
                Route::get('/edit/{kapasitasProduksi}', [KapasitasProduksiController::class, 'edit'])->name('kapasitasProduksi.edit');
                Route::put('/update/{kapasitasProduksi}', [KapasitasProduksiController::class, 'update'])->name('kapasitasProduksi.update');
                Route::delete('/delete/{id}', [KapasitasProduksiController::class, 'destroy'])->name('kapasitasProduksi.destroy');
            });
            Route::group(['prefix' => 'teams'], function () {
                Route::get('/', [TeamsController::class, 'index'])->name('teams.index');
                Route::get('/create', [TeamsController::class, 'create'])->name('teams.create');
                Route::post('/store', [TeamsController::class, 'store'])->name('teams.store');
                Route::get('/edit/{teams}', [TeamsController::class, 'edit'])->name('teams.edit');
                Route::put('/update/{teams}', [TeamsController::class, 'update'])->name('teams.update');
                Route::delete('/delete/{id}', [TeamsController::class, 'destroy'])->name('teams.destroy');
            });
        });

        Route::group(['prefix' => 'research'], function () {
            Route::group(['prefix' => 'heroSection'], function () {
                Route::get('/', [SectionHeroController::class, 'research'])->name('heroResearch.index');
                Route::post('/store', [SectionHeroController::class, 'store'])->name('heroResearch.store');
                Route::get('/edit/{id}', [SectionHeroController::class, 'editResearch'])->name('heroResearch.edit');
                Route::put('/update/{id}', [SectionHeroController::class, 'update'])->name('heroResearch.update');
            });
            Route::group(['prefix' => 'headerResearch'], function () {
                Route::get('/', [SectionHeaderController::class, 'research'])->name('headerResearch.index');
                Route::post('/store', [SectionHeaderController::class, 'store'])->name('headerResearch.store');
                Route::get('/edit/{id}', [SectionHeaderController::class, 'editResearch'])->name('headerResearch.edit');
                Route::put('/update/{id}', [SectionHeaderController::class, 'update'])->name('headerResearch.update');
            });
            Route::group(['prefix' => 'dataResearch'], function () {
                Route::get('/', [ResearchController::class, 'index'])->name('dataResearch.index');
                Route::get('/create', [ResearchController::class, 'create'])->name('dataResearch.create');
                Route::post('/store', [ResearchController::class, 'store'])->name('dataResearch.store');
                Route::get('/edit/{research}', [ResearchController::class, 'edit'])->name('dataResearch.edit');
                Route::put('/update/{research}', [ResearchController::class, 'update'])->name('dataResearch.update');
                Route::delete('/delete/{id}', [ResearchController::class, 'destroy'])->name('dataResearch.destroy');
            });
        });
    });

    Route::group(['prefix' => 'galleryPage'], function () {
        Route::group(['prefix' => 'hero'], function () {
            Route::get('/', [GalleryController::class, 'hero'])->name('galleryHero.index');
            Route::post('/store', [GalleryController::class, 'storeHero'])->name('galleryHero.store');
            Route::get('/edit/{id}', [GalleryController::class, 'editHero'])->name('galleryHero.edit');
            Route::put('/update/{id}', [GalleryController::class, 'updateHero'])->name('galleryHero.update');
        });

        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/', [GalleryController::class, 'index'])->name('dataGallery.index');
            Route::post('/store', [GalleryController::class, 'store'])->name('dataGallery.store');
            Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('dataGallery.destroy');
        });
    });

    Route::group(['prefix' => 'productPage'], function () {

        Route::group(['prefix' => 'heroSection'], function () {
            Route::get('/', [AdminProductController::class, 'hero'])->name('productHero.index');
            Route::post('/store', [AdminProductController::class, 'heroStore'])->name('productHero.store');
            Route::get('/edit/{id}', [AdminProductController::class, 'heroEdit'])->name('productHero.edit');
            Route::put('/update/{id}', [AdminProductController::class, 'heroUpdate'])->name('productHero.update');
        });

        Route::group(['prefix' => 'attribute'], function () {
            Route::get('/', [AttributeController::class, 'index'])->name('attribute.index');
            Route::get('/create', [AttributeController::class, 'create'])->name('attribute.create');
            Route::post('/post', [AttributeController::class, 'store'])->name('attribute.store');
            Route::get('/edit/{attribute}', [AttributeController::class, 'edit'])->name('attribute.edit');
            Route::put('/update/{attribute}', [AttributeController::class, 'update'])->name('attribute.update');
            Route::delete('/delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.destroy');
            Route::get('/attributeValue/{id}', [AttributeValueController::class, 'index'])->name('attributeValue.index');
            Route::post('/attributeValue', [AttributeValueController::class, 'store'])->name('attributeValue.store');
            Route::get('/attributeValue/edit/{attributeValue}', [AttributeValueController::class, 'edit'])->name('attributeValue.edit');
            Route::put('/attributeValue/update/{attributeValue}', [AttributeValueController::class, 'update'])->name('attributeValue.update');
        });
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('prod.index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('prod.create');
            Route::post('/store', [AdminProductController::class, 'store'])->name('prod.store');
            Route::post('/storeAttribute', [ProductAttributeController::class, 'store'])->name('storeAtr.store');
            Route::post('/storeImage', [ProductImageController::class, 'store'])->name('image.store');
            Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('prod.edit');
            Route::delete('edit/deleteImage/{id}', [ProductImageController::class, 'destroy'])->name('image.delete');
            Route::delete('edit/deleteAttribute/{id}', [ProductAttributeController::class, 'destroy'])->name('dltAttribute.delete');
            Route::put('/update/{id}', [AdminProductController::class, 'update'])->name('prod.update');
            Route::delete('/delete/{id}', [AdminProductController::class, 'destroy'])->name('prod.destroy');
        });
    });

    Route::group(['prefix' => 'messagePage'], function () {
        Route::group(['prefix' => 'heroSection'], function () {
            Route::get('/', [MessageController::class, 'hero'])->name('messageHero.index');
            Route::post('/store', [MessageController::class, 'heroStore'])->name('messageHero.store');
            Route::get('/edit/{id}', [MessageController::class, 'heroEdit'])->name('messageHero.edit');
            Route::put('/update/{id}', [MessageController::class, 'heroUpdate'])->name('messageHero.update');
        });
        Route::group(['prefix' => 'message'], function () {
            Route::get('/', [KontakController::class, 'message'])->name('message.index');
            Route::get('/show/{id}', [KontakController::class, 'show'])->name('message.show');
            Route::delete('/delete/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
        });
    });

    Route::group(['prefix' => 'permissionPage'], function () {
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::get('/detail/{id}', [RoleController::class, 'show'])->name('role.show');
            Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('user.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('user.store');
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
            Route::put('/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{id}', [AdminUserController::class, 'destroy'])->name('user.delete');
        });

    });


    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');
    });

    Route::view('/file-manager', 'admin.file-manager.index')->name('file-manager');
});

require __DIR__ . '/auth.php';
