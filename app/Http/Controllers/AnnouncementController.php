<?php

namespace App\Http\Controllers;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function createAnnouncement()
    {
        return view('announcement.createannouncement'); 
    }

    public function insertAnnouncement(Request $request)
    {
        $week = $request->input('week');
        $title = $request->input('title');
        $date = $request->input('date');
        $time = $request->input('time');
        $info = $request->input('information');


        $data = array(
            'week' => $week,
            'title' => $title,
            'date' => $date,
            'time' => $time,
            'information' => $info,
        );

        // insert query
        DB::table('announcement')->insert($data);

        return redirect()->back()->with('message', 'Create Announcement Successfully');
    }

    public function viewAnnouncement($id)
    {
        $announcementview = DB::table('announcement')
                            ->where('id', $id)
                            ->first();

        return view('announcement.editannouncement', compact('announcementview')); 
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $updateAnnouncement = Announcement::find($id); //model name

        $updateAnnouncement->week = $request->input('week');
        $updateAnnouncement->title = $request->input('title'); //blue from name input value
        $updateAnnouncement->date = $request->input('date');
        $updateAnnouncement->time = $request->input('time');
        $updateAnnouncement->information = $request->input('information');

        $updateAnnouncement->update();

        return redirect()->back()->with('message', 'Announcement Updated Successfully');
    }

    public function deleteAnnouncement($id)
    {
        $deleteAnnouncement = Announcement::find($id); //model name
        
        if ($deleteAnnouncement) {
            // If the record exists, delete it
            $deleteAnnouncement->delete();
        }

        return redirect()->route('dashboard');

    }
}
