<?php

namespace App\Http\Controllers;

use App\Enums\PollStatus;
use App\Http\Requests\CreatePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function store(CreatePollRequest $request)
    {
        // $request->validated() để sử dụng các trường đã được xác thực
        // $poll = auth()->user()->polls()->create($request->validated());

        // $request->safe()->except('options') để sử dụng các trường an toàn sau khi loại bỏ trường 'options'
        // tức là các trường không có nguy cơ gây ra tác động không mong muốn hoặc lỗi bảo mật

        // Create Poll
        $poll = auth()->user()->polls()->create($request->safe()->except('options'));
        // Create Options
        $options = $poll->options()->createMany($request->options);
        return to_route('poll.index');
    }

    public function index()
    {
        // Get Polls
        $polls = auth()->user()->polls()->select('title', 'status', 'id')->paginate(10);
        return view('polls.list', compact('polls'));
    }

    public function edit(Poll $poll)
    {
        // Nếu mà id user không phải là chủ bài viết thì không cho chỉnh sửa
        abort_if(auth()->user()->isNot($poll->user), 403);
        // Chỉ có status là started mới cho chỉnh sửa
        abort_if($poll->status !== PollStatus::STARTED->value, 404);
        // Get Detail Poll With Options
        $poll = $poll->load('options');
        return view('polls.update', compact('poll'));
    }

    public function update(UpdatePollRequest $request, Poll $poll)
    {
        $data = $request->safe()->except('options');

        // Update Poll
        $poll->update($data);
        // Delete All Old Option
        $poll->options()->delete();
        // Create New Option
        $poll->options()->createMany($request->options);

        return to_route('poll.index');
    }

    public function delete(Poll $poll)
    {
        // Chỉ cho phép xóa poll có status là pending
        if ($poll->status !== PollStatus::PENDING->value) {
            abort(404, 'Only polls with pending status can be deleted');
        }
        // Delete Poll With Options
        $poll->options()->delete();
        $poll->delete();
        return back();
    }

    public function show(Poll $poll)
    {
        abort_if($poll->status !== PollStatus::STARTED->value, 404);

        // Get Poll With All Options
        $poll = $poll->load('options');

        // Get Poll Is Selected By Author
        // Mỗi người dùng chỉ được vote 1 poll 1 lần. Mà 1 poll thì có nhiều lượt vote
        $selectedOption = $poll->votes()->where('user_id', auth()->id())->first()?->option_id;

        if ($poll->user->is(auth()->user())) {
            return view('polls.show', compact('poll', 'selectedOption'));
        }

        return view('polls.show', compact('poll', 'selectedOption'));
    }

    public function vote(VoteRequest $request, Poll $poll)
    {
        abort_if($poll->status !== PollStatus::STARTED->value, 404);

        $selectedOption = $poll->votes()->where('user_id', auth()->id())->first()?->option;

        // Tìm kiếm votes có thuộc tính user_id là chính id của người dùng đang đăng nhập.
        // Nếu tìm thấy, nó sẽ cập nhật thuộc tính option_id thành chính cái id đang nhận vô.
        // Nếu không tìm thấy, nó sẽ tạo mới một bản ghi với các thuộc tính và giá trị tương ứng.
        $poll->votes()->updateOrCreate(['user_id' => auth()->id()], ['option_id' => $request->option_id]);

        $newOption =  Option::find($request->option_id);
        $newOption->increment('votes_count');

        if ($selectedOption) {
            $selectedOption->decrement('votes_count');
        }

        $selectedOption = $newOption;
        return back();
    }
}
