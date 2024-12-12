import { slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type EventProgramCardProps = {
  eventProgram: App.Data.EventProgram.EventProgramData;
};

export default function EventProgramCard({ eventProgram }: EventProgramCardProps) {
  const href = route('event-programs.show', [slugifyId(eventProgram.id, eventProgram.title)]);

  return (
    <div className="card h-full bg-base-100 shadow">
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200">
          {eventProgram.image && (
            <Image
              className="size-full"
              src={eventProgram.image?.original_url}
              alt={eventProgram.title}
            />
          )}
        </figure>
      </Link>
      <div className="card-body">
        <h2 className="card-title">{eventProgram.title}</h2>
        {eventProgram.short_description && (
          <p className="max-h-fit text-sm text-base-content/80">{eventProgram.short_description}</p>
        )}
        <div className="mt-2 flex flex-wrap items-center gap-1">
          {eventProgram.categories.map((category) => (
            <span key={category.id} className="badge badge-md mt-2 bg-base-200">
              {category.title}
            </span>
          ))}
        </div>
        <Link className="btn mt-4 md:mt-auto" href={href}>
          اطلاعات بیشتر
        </Link>
      </div>
    </div>
  );
}
