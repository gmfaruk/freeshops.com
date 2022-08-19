<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Carbon\Carbon;
use DataTables;
use User;
use Str;

class BlogCategoryController extends Controller
{
    public function list(Request $req)
    {
        $list = BlogCategory::orderBy('name', 'ASC')->get();
        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('status', function($row) {
                    if ($row->status == 1) {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-success cursor-pointer" onclick="alertMessage(\''. route('admin.blog.categories.status.change', [$row->id, 'status']) .'\', \'You want to change the status to disabled?\')">Active</span>';
                    } else {
                        $statusCol = '<span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer" onclick="alertMessage(\''. route('admin.blog.categories.status.change', [$row->id, 'status']) .'\', \'You want to change the status to active?\')">Disabled</span>';
                    }
                    return $statusCol;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a href="'.route('admin.blog.categories.edit', $row->id).'"><i class="fas fa-edit text-info font-16"></i></a>
                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert(\''.route('admin.blog.categories.delete', $row->id).'\')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['date','status','action'])
                ->make(true);
        } else {
            return view('admin.blog_categories.list', get_defined_vars());
        }
    }

    public function add()
    {
        return view('admin.blog_categories.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $category = BlogCategory::find($id);

        return view('admin.blog_categories.edit', get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {
        $req->validate([
            'name' => 'required|max:191',
        ]);

        if (is_null($id)) {
            # Create
            BlogCategory::create([
                'name' => $req->name,
                'slug' => Str::slug($req->name),
                'description' => $req->description,
            ]);

            $msg = "New Blog Category Added Successfully!";
        } else {
            # Edit
            BlogCategory::find($id)->update([
                'name' => $req->name,
                'slug' => Str::slug($req->name),
                'description' => $req->description,
            ]);

            $msg = "Blog Category Updated Successfully!";
        }

        return redirect()->route('admin.blog.categories.list')->with('success', $msg);
    }

    public function delete($id = null)
    {
        $category = BlogCategory::find($id)->delete();

        return redirect()->route('admin.blog.categories.list')->with('success', 'Blog Category Successfully Deleted!');
    }

    public function statusChange($id = null)
    {
        $category = BlogCategory::find($id);
        if ($category->status == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        $category->save();

        return redirect()->route('admin.blog.categories.list')->with('success', 'Blog Category Status Changed Successfully!');
    }
}
