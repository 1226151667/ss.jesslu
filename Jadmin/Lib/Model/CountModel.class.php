<?php 
class CountModel extends Model{
	public function dataPage(){
		$obj = M("visit");
		$data = $obj->query("
				select v.month,uCnt,vCnt,qCnt,anCnt,arCnt,jCnt,rewCnt,repCnt,cCnt from 
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) vCnt from visit group by month) v
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) uCnt from user group by month) u
				on v.month=u.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) qCnt from question group by month) q
				on v.month=q.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) anCnt from answer group by month) an
				on v.month=an.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) arCnt from article group by month) ar
				on v.month=ar.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) jCnt from jbi where state=1 group by month) j
				on v.month=j.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) rewCnt from reward group by month) rew
				on v.month=rew.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) repCnt from reply group by month) rep
				on v.month=rep.month
				left join
				(select DATE_FORMAT(tm,'%Y-%m') month,count(*) cCnt from comment group by month) c
				on v.month=c.month
				order by v.month desc
			");
		return $data;
	}
	public function Data(){
		$user = M("user");
		$question = M("question");
		$answer = M("answer");
		$article = M("article");
		$jbi = M("jbi");
		$reward = M("reward");
		$comment = M("comment");
		$reply = M("reply");
		$visit = M("visit");
		$data = array();
		$data['user'] = $user->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from user where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['question'] = $question->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from question where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['answer'] = $answer->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from answer where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['article'] = $article->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from article where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['jbi'] = $jbi->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from jbi where state=1 and tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->where("state=1")->select();
		$data['reward'] = $reward->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from reward where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['visit'] = $visit->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from visit where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt,
			(select count(distinct(ip)) from visit where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) iptCnt,
			(select count(distinct(ip)) from visit where tm>date and tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) ipCnt
			")->group("date")->limit("15")->select();
		$data['comment'] = $comment->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from comment where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		$data['reply'] = $reply->field("DATE_FORMAT(tm,'%Y-%m-%d') date,count(*) cnt,
			(select count(*) from reply where tm<date_add(date_format(date,'%Y-%m-%d 00:00:00'),interval 1 day)) tCnt")
			->group("date")->limit("15")->select();
		// return $data;
		return json_encode($data);
	}
}