import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import ShareButton from '@/shared/resources/show/ShareButton';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiOutlineCheck, HiStar } from 'react-icons/hi2';
import Markdown from 'react-markdown';
import { toast } from 'react-toastify';

type TPage = PageProps<{
  reward_program: App.Data.RewardProgram.RewardProgramFullData;
  recommended_reward_programs: App.Data.RewardProgram.RewardProgramData[];
}>;

const registerId = 'registerId';

export default function Show() {
  const { reward_program, recommended_reward_programs } = usePage<TPage>().props;

  const handleScrollToRegister = () => {
    document.getElementById(registerId)?.scrollIntoView({ behavior: 'smooth' });
  };

  const handleRegister = () => {
    toast.warning('گرفتن خدمات فعلا امکان پذیر نیست لطفا چند روز دیگر لطفا دوباره تلاش کنید.');
  };

  return (
    <div className="space-y mt-page container">
      <Head
        title={`خدمت ${reward_program.title}`}
        description={reward_program.short_description}
        imageUrl={reward_program.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'خدمات', href: route('reward-programs.index') },
          { title: reward_program.title, href: '#' },
        ]}
      />
      <div className="grid grid-cols-10 gap-4">
        <div className="space-y col-span-full lg:col-span-7">
          {reward_program.image && (
            <Image
              className="w-full rounded-box object-cover lg:hidden"
              src={reward_program.image.original_url}
              alt={reward_program.title}
            />
          )}
          <div className="space-y-3">
            <div className="flex flex-wrap items-center justify-between gap-4">
              <h1 className="h1">{reward_program.title}</h1>
              <ShareButton predefinedStyleFor="desktop" />
            </div>
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
            <div className="flex flex-wrap items-center justify-between gap-4 rounded-box bg-base-200 text-base-content/80 md:hidden">
              <Button onClick={handleScrollToRegister} className="btn btn-ghost">
                <HiOutlineCheck className="size-5" />
                <span>گرفتن خدمت</span>
              </Button>
              <ShareButton predefinedStyleFor="mobile" />
            </div>
          </div>
          <Markdown className="prose max-w-none text-base-content">
            {reward_program.description}
          </Markdown>
        </div>
        <div className="col-span-full lg:col-span-3">
          <div id={registerId} className="card sticky left-0 top-3 bg-base-200">
            <div className="card-body">
              {reward_program.image && (
                <>
                  <Image
                    className="hidden w-full rounded-box object-cover lg:block"
                    src={reward_program.image.original_url}
                    alt={reward_program.title}
                  />
                  <div className="divider" />
                </>
              )}
              <ul className="list-inside list-disc text-base-content/80">
                <li>
                  نیاز به{' '}
                  <span className="font-medium">
                    {digitsEnToFa(addCommas(reward_program.required_score))}
                  </span>{' '}
                  امتیاز
                </li>
              </ul>
              <div className="card-actions mt-4">
                <Button onClick={handleRegister} className="btn btn-neutral btn-block">
                  گرفتن خدمت
                </Button>
              </div>
            </div>
          </div>
        </div>
      </div>
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
