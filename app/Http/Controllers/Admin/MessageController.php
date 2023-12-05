<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionTitleRequest;
use App\Http\Requests\UpdateSectionTitleRequest;
use App\Models\admin\SectionTitle;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function hero()
    {
        $titleMessage = SectionTitle::where('id_title','contact')->count();
        if ($titleMessage < 1) {
            return view('admin.MessagePage.hero.create');
        } else {
            $titleMessage = SectionTitle::where('id_title', 'contact')->first();
            return view('admin.MessagePage.hero.index', compact('titleMessage'));
        }
    }

    public function heroStore(StoreSectionTitleRequest $request)
    {
        SectionTitle::create([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('messageHero.index')->with(['success' => 'data berhasil ditambahkan']);
    }

    public function heroEdit($id)
    {
        $titleMessage = SectionTitle::findOrFail($id);
        return view('admin.MessagePage.hero.edit', compact('titleMessage'));
    }

    public function heroUpdate(UpdateSectionTitleRequest $request, $id)
    {
        $titleMessage = SectionTitle::findOrFail($id);
        $titleMessage->update([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('messageHero.index')->with(['success' => 'data berhasil diubah']);
    }

    public function destroy($id)
    {
        $message =   Message::findOrFail($id);
        $message->delete();
        if($message){
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
