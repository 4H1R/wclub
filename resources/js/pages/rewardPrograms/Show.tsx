import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import Button from '@/shared/forms/Button';
import Image from '@/shared/images/Image';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiOutlineRocketLaunch, HiStar } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  reward_program: App.Data.RewardProgram.RewardProgramFullData;
  recommended_reward_programs: App.Data.RewardProgram.RewardProgramData[];
}>;

export default function Show() {
  const { reward_program, recommended_reward_programs } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <BreadCrumb
        links={[
          { title: 'خدمات', href: route('reward-programs.index') },
          { title: reward_program.title, href: '#' },
        ]}
      />
      {reward_program.image && (
        <Image
          className="w-full rounded-box object-contain lg:float-left lg:max-w-lg lg:pb-4"
          src={reward_program.image?.original_url}
          alt={reward_program.title}
        />
      )}
      <h1 className="h1">{reward_program.title}</h1>
      <div className="flex flex-wrap items-center gap-2 gap-y-3">
        <div className="tooltip tooltip-top" data-tip="امتیاز مورد نیاز">
          <div className="badge badge-lg flex items-center justify-center gap-2 bg-yellow-600 text-white">
            <HiStar className="size-4" />
            <span className="font-fa-display">
              {digitsEnToFa(addCommas(reward_program.required_score))}
            </span>
          </div>
        </div>
        {reward_program.categories.map((category) => (
          <span key={category.id} className="badge badge-md bg-base-200">
            {category.title}
          </span>
        ))}
      </div>
      <Markdown className="prose max-w-none">{reward_program.content}</Markdown>
      <Button className="btn btn-secondary">
        <span>نهایی کردن خدمت</span>
        <HiOutlineRocketLaunch className="size-6" />
      </Button>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">خدمات دیگر</h2>
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        {recommended_reward_programs.map((rewardProgram) => (
          <RewardProgramCard key={rewardProgram.id} rewardProgram={rewardProgram} />
        ))}
      </div>
    </div>
  );
}
