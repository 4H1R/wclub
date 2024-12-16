import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import EventProgramCard from '@/shared/cards/EventProgramCard';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import CategoriesBadge from '@/shared/resources/show/CategoriesBadge';
import ShareButton from '@/shared/resources/show/ShareButton';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiOutlineCheck } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  event_program: App.Data.EventProgram.EventProgramFullData;
  recommended_event_programs: App.Data.EventProgram.EventProgramData[];
}>;

const registerId = 'registerId';

const timeOptions = {
  year: 'numeric',
  month: 'numeric',
  day: 'numeric',
  hour: '2-digit',
  minute: '2-digit',
} as const;

export default function Show() {
  const { event_program, recommended_event_programs } = usePage<TPage>().props;

  const handleScrollToRegister = () => {
    document.getElementById(registerId)?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <div className="space-y mt-page container">
      <Head
        title={`رویداد ${event_program.title}`}
        description={event_program.short_description ?? event_program.title}
        imageUrl={event_program.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'رویداد ها', href: route('event-programs.index') },
          { title: event_program.title, href: '#' },
        ]}
      />
      <div className="grid grid-cols-10 gap-4">
        <div className="space-y col-span-full md:col-span-7">
          {event_program.image && (
            <Image
              className="w-full rounded-box object-contain"
              src={event_program.image?.original_url}
              alt={event_program.title}
            />
          )}
          <div className="space-y-3">
            <div className="flex flex-wrap items-center justify-between gap-4">
              <h1 className="h1">{event_program.title}</h1>
              <ShareButton predefinedStyleFor="desktop" />
            </div>
            <CategoriesBadge categories={event_program.categories} />
            <div className="flex flex-wrap items-center justify-between gap-4 rounded-box bg-base-200 text-base-content/80 md:hidden">
              <Button onClick={handleScrollToRegister} className="btn btn-ghost">
                <HiOutlineCheck className="size-5" />
                <span>ثبت نام</span>
              </Button>
              <ShareButton predefinedStyleFor="mobile" />
            </div>
          </div>
          <Markdown className="prose max-w-none text-base-content">
            {event_program.content}
          </Markdown>
        </div>
        <div className="col-span-full md:col-span-3">
          <div id={registerId} className="card sticky left-0 top-3 bg-base-200">
            <div className="card-body">
              <ul className="list-inside list-disc text-base-content/80">
                {event_program.min_participants && (
                  <li>حداقل {digitsEnToFa(addCommas(event_program.min_participants))} فرد</li>
                )}
                {event_program.max_participants && (
                  <li>حداکثر {digitsEnToFa(addCommas(event_program.max_participants))} فرد</li>
                )}
                <li>
                  شروع از{' '}
                  {new Intl.DateTimeFormat('fa-IR', timeOptions).format(
                    new Date(event_program.started_at),
                  )}{' '}
                  تا{' '}
                  {new Intl.DateTimeFormat('fa-IR', timeOptions).format(
                    new Date(event_program.finished_at),
                  )}
                </li>
              </ul>
              <div className="card-actions mt-4">
                <Button className="btn btn-neutral btn-block">ثبت نام</Button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">رویداد های دیگر</h2>
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        {recommended_event_programs.map((eventProgram) => (
          <EventProgramCard key={eventProgram.id} eventProgram={eventProgram} />
        ))}
      </div>
    </div>
  );
}
