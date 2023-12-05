<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Font;
use App\Models\admin\SectionFont;
use Illuminate\Http\Request;

class ChangeFontController extends Controller
{
    public function headerVideo()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeaderVideo')->first();
        $fontSubTitle = SectionFont::where('name_values', 'subTitleHeaderVideo')->first();
        return view('admin.HomePage.headerVideo.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function about()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleAbout')->first();
        $fontSubTitle = SectionFont::where('name_values', 'subTitleAbout')->first();
        return view('admin.HomePage.about.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function titleNews()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleNews')->first();
        $fontSubTitle = SectionFont::where('name_values', 'subTitleNews')->first();
        return view('admin.HomePage.news.title.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function titlePost()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titlePost')->first();
        $fontSubTitle = SectionFont::where('name_values', 'subTitlePost')->first();
        return view('admin.HomePage.news.post.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function titleCategory()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleCategoryNews')->first();
        return view('admin.HomePage.news.kategori.font', compact(['fontTitle','fonts']));
    }

    public function titleArea()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle1 = SectionFont::where('name_values','titleArea1')->first();
        $fontTitle2 = SectionFont::where('name_values','titleArea2')->first();
        $fontTitle3 = SectionFont::where('name_values','titleArea3')->first();
        $fontTitle4 = SectionFont::where('name_values','titleArea4')->first();
        return view('admin.HomePage.aboutKaligandu.font', compact(['fontTitle1','fontTitle2','fontTitle3','fontTitle4','fonts']));
    }

    public function titleHeroAboutPage()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeroAboutPage')->first();
        $fontTitleLink = SectionFont::where('name_values','titleHeroAboutPageLink')->first();
        $fontDescription = SectionFont::where('name_values', 'subTitleHeroAboutPage')->first();
        return view('admin.AboutPage.history.hero.font', compact(['fontTitle','fontDescription','fontTitleLink','fonts']));
    }

    public function titleAboutMaswe()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleAboutMaswe')->first();
        $fontOther = SectionFont::where('name_values','titleOther')->first();
        $fontDescription = SectionFont::where('name_values', 'titleDescriptionAboutMaswe')->first();
        return view('admin.AboutPage.history.aboutMaswe.font', compact(['fontTitle','fontDescription','fontOther','fonts']));
    }

    public function fontLongHistories()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleLongHistories')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleDescription')->first();
        return view('admin.AboutPage.history.longHistory.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function fontHeroValues()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeroValues')->first();
        $fontTitleLink = SectionFont::where('name_values','titleHeroValuesLink')->first();
        $fontDescription = SectionFont::where('name_values', 'subTitleHeroValues')->first();
        return view('admin.AboutPage.valuesPeople.hero.font', compact(['fontTitle','fontDescription','fontTitleLink','fonts']));
    }

    public function fontHeaderValues()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeaderValues')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleHeaderDescription')->first();
        return view('admin.AboutPage.valuesPeople.headerSection.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function fontFounderPeople()
    {
        $fonts = Font::orderBy('font')->get();
        $fontName = SectionFont::where('name_values','titleNameFounder')->first();
        $fontJabatan = SectionFont::where('name_values', 'titleJabatan')->first();
        return view('admin.AboutPage.valuesPeople.founder.font', compact(['fontName','fonts','fontJabatan']));
    }

    public function fontHeroField()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeroField')->first();
        $fontTitleLink = SectionFont::where('name_values','titleHeroFieldLink')->first();
        $fontDescription = SectionFont::where('name_values', 'subTitleField')->first();
        return view('admin.AboutPage.field.hero.font', compact(['fontTitle','fontDescription','fontTitleLink','fonts']));
    }

    public function fontHeaderField()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeaderField')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleSubHeaderField')->first();
        return view('admin.AboutPage.field.headerFasilitasProduksi.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function fontHeaderTeam()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleHeaderTeam')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleSubHeaderTeam')->first();
        return view('admin.AboutPage.field.headerTeam.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function fontFasilitasProduksi()
    {
        $fonts = Font::orderBy('font')->get();
        $fontTitle = SectionFont::where('name_values','titleFasilitasProduksi')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleSubFasilitasProduksi')->first();
        return view('admin.AboutPage.field.fasilitasProduksi.font', compact(['fontTitle','fonts','fontSubTitle']));
    }

    public function storeFont(Request $request)
    {
        $storeFont = SectionFont::updateOrCreate(
            ['name_values' =>  request('name_values')],
            ['type_fonts' => request('type_fonts')]
        );
        if($storeFont){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
