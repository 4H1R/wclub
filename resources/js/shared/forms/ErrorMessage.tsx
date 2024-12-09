import { useContext } from 'react';
import { formContext } from './Form';

type ErrorMessageProps = {
  name: string;
};

export default function ErrorMessage({ name }: ErrorMessageProps) {
  const { errors } = useContext(formContext);
  const error = errors[name];

  if (!error) return null;

  return <p className="mt-1 text-sm text-error">{error}</p>;
}
