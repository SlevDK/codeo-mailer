<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Exceptions\Api\NotFoundException;
use App\Http\Requests\Api\v1\Database\FileStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// TODO: move file logic to service class
class FileController extends Controller
{
    /** @var string User home file path */
    protected $user_path;

    /**
     * FileController constructor.
     */
    public function __construct()
    {
        $this->user_path = 'database_files/'.auth('api')->id().'/';

        // lets make user_file dir if not exists
        if(!Storage::exists($this->user_path))
            Storage::makeDirectory($this->user_path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response([
            'code'      => '20',
            'message'   => 'Success',
            'payload'   => $this->getDirData()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileStoreRequest $request
     * @return Response
     */
    public function store(FileStoreRequest $request)
    {
        if($request->has('name'))
            Storage::makeDirectory($this->user_path.$request->name);

        if($request->hasFile('file'))
            $request->file->storeAs(
                $this->user_path,
                $request->file->getClientOriginalName()
            );

        return response([
            'code'      => '20',
            'message'   => 'Success',
            'payload'   => $this->getDirData(),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param string $directory
     * @return Response
     * @throws NotFoundException
     */
    public function show($directory)
    {
        if(!Storage::exists($this->user_path.$directory))
            throw new NotFoundException();

        return response([
            'code'      => '20',
            'message'   => 'Success',
            'payload'   => $this->getDirData($directory),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $name
     * @return Response
     * @throws NotFoundException
     */
    public function destroy($name)
    {
        if(!Storage::exists($this->user_path.$name))
            throw new NotFoundException();

        if(File::isDirectory(storage_path('app/'.$this->user_path.$name))) {
            Storage::deleteDirectory($this->user_path.$name);
        } else {
            Storage::delete($this->user_path.$name);
        }

        return response([
            'code'      => '20',
            'message'   => 'Success',
            'payload'   => $this->getDirData(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage's directory.
     *
     * @param FileStoreRequest $request
     * @param string $directory
     * @return Response
     * @throws NotFoundException
     */
    public function storeToDirectory(FileStoreRequest $request, $directory)
    {
        if(!Storage::exists($this->user_path.$directory))
            throw new NotFoundException();

        if($request->hasFile('file'))
            $request->file->storeAs(
                $this->user_path.$directory,
                $request->file->getClientOriginalName()
            );

        return response([
            'code'      => '20',
            'message'   => 'Success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage's directory.
     *
     * @param string $directory
     * @param string $file
     * @return Response
     * @throws NotFoundException
     */
    public function destroyFromDirectory($directory, $file)
    {
        // check is dor and/or file exists
        if(!Storage::exists($this->user_path.$directory) || !Storage::exists($this->user_path.$directory.'/'.$file))
            throw new NotFoundException();

        Storage::delete($this->user_path.$directory.'/'.$file);

        return response([
            'code'      => '20',
            'message'   => 'Success',
        ], 200);
    }

    /**
     * Return directory data (user_path by default)
     *
     * @param null $dir
     * @return Collection
     */
    protected function getDirData($dir = null)
    {
        $folder = $this->user_path.str_replace('/', '', $dir);

        // get folder data
        $folder = array_merge(Storage::directories($folder), Storage::files($folder));
        $result = new Collection();

        // fill result collection
        foreach($folder as $k => $v) {
            $file_base_path = storage_path('app/'.$v);

            $result->push([
                'name'  => File::isDirectory($file_base_path)?
                    File::name($file_base_path) : File::name($file_base_path).'.'.File::extension($file_base_path),
                'type'  => File::isDirectory($file_base_path)? 'directory' : 'file'
            ]);
        }

        return $result;
    }
}
