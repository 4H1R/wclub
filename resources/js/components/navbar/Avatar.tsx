type AvatarProps = {
  title: string;
};

export default function Avatar({ title }: AvatarProps) {
  return (
    <div className="avatar placeholder">
      <div className="size-10 rounded-full bg-primary text-primary-content">
        <span className="text-sm">{title.at(0)}</span>
      </div>
    </div>
  );
}
