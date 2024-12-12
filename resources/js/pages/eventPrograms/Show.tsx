import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import EventProgramCard from '@/shared/cards/EventProgramCard';
import Button from '@/shared/forms/Button';
import Image from '@/shared/images/Image';
import { usePage } from '@inertiajs/react';
import { HiOutlineRocketLaunch } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  event_program: App.Data.EventProgram.EventProgramFullData;
  recommended_event_programs: App.Data.EventProgram.EventProgramData[];
}>;

export default function Show() {
  const { event_program, recommended_event_programs } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <BreadCrumb
        links={[
          { title: 'رویداد ها', href: route('event-programs.index') },
          { title: event_program.title, href: '#' },
        ]}
      />
      {event_program.image && (
        <Image
          className="w-full rounded-box object-contain lg:float-left lg:max-w-lg lg:pb-4"
          src={event_program.image?.original_url}
          alt={event_program.title}
        />
      )}
      <h1 className="h1">{event_program.title}</h1>
      <div className="flex flex-wrap items-center gap-2 gap-y-3">
        {event_program.categories.map((category) => (
          <span key={category.id} className="badge badge-md bg-base-200">
            {category.title}
          </span>
        ))}
      </div>
      <Markdown className="prose max-w-none">{event_program.content}</Markdown>
      <Button className="btn btn-secondary">
        <span>شرکت کردن</span>
        <HiOutlineRocketLaunch className="size-6" />
      </Button>
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
