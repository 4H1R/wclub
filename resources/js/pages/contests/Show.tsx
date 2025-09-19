import { PageProps } from '@/@types';
import RegisterContest from '@/components/contests/RegisterContest';
import BreadCrumb from '@/shared/BreadCrumb';
import ContestCard from '@/shared/cards/ContestCard';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import CategoriesBadge from '@/shared/resources/show/CategoriesBadge';
import ShareButton from '@/shared/resources/show/ShareButton';
import { formatDatetime, slugifyId } from '@/utils';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiOutlineCheck } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  contest: App.Data.Contest.ContestFullData;
  recommended_contests: App.Data.Contest.ContestData[];
}>;

const registerId = 'registerId';

export default function Show() {
  const { contest, recommended_contests } = usePage<TPage>().props;

  const handleScrollToRegister = () => {
    document.getElementById(registerId)?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('contests.show', [slugifyId(contest.id, contest.title)])}
        title={`چالش ${contest.title}`}
        description={contest.short_description}
        imageUrl={contest.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'چالش ها و مسابقات', href: route('contests.index') },
          { title: contest.title, href: '#' },
        ]}
      />
      <div className="grid grid-cols-10 gap-4">
        <div className="space-y col-span-full lg:col-span-7">
          {contest.image && (
            <Image
              className="w-full rounded-box object-cover lg:hidden"
              src={contest.image.original_url}
              alt={contest.title}
            />
          )}
          <div className="flex flex-col gap-3">
            <div className="flex flex-wrap items-center justify-between gap-4">
              <h1 className="h1">{contest.title}</h1>
              <ShareButton predefinedStyleFor="desktop" />
            </div>
            <CategoriesBadge categories={contest.categories} />
            <div className="flex flex-wrap items-center justify-between gap-4 rounded-box bg-base-200 text-base-content/80 md:hidden">
              <Button onClick={handleScrollToRegister} className="btn btn-ghost">
                <HiOutlineCheck className="size-5" />
                <span>ثبت نام</span>
              </Button>
              <ShareButton predefinedStyleFor="mobile" />
            </div>
          </div>
          <div className="prose max-w-none text-base-content">
            <Markdown>{contest.description}</Markdown>
          </div>
        </div>
        <div className="col-span-full lg:col-span-3">
          <div id={registerId} className="card sticky left-0 top-3 bg-base-200">
            <div className="card-body">
              {contest.image && (
                <>
                  <Image
                    className="hidden w-full rounded-box object-cover lg:block"
                    src={contest.image.original_url}
                    alt={contest.title}
                  />
                  <div className="divider hidden lg:block" />
                </>
              )}
              <ul className="list-inside list-disc text-base-content/80">
                {Boolean(contest.min_participants) && (
                  <li>حداقل {digitsEnToFa(addCommas(contest.min_participants as number))} فرد</li>
                )}
                {Boolean(contest.max_participants) && (
                  <li>حداکثر {digitsEnToFa(addCommas(contest.max_participants as number))} فرد</li>
                )}
                <li>
                  شروع از {formatDatetime(contest.started_at)} تا{' '}
                  {formatDatetime(contest.finished_at)}
                </li>
              </ul>
              <div className="card-actions mt-4">
                <RegisterContest contest={contest} />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">چالش ها و مسابقات دیگر</h2>
      <div className="content-grid-container show-content-grid-container">
        {recommended_contests.map((contest) => (
          <ContestCard key={contest.id} contest={contest} />
        ))}
      </div>
    </div>
  );
}
