import { PageProps } from '@/@types';
import Button from '@/shared/forms/Button';
import FieldWrapper from '@/shared/forms/FieldWrapper';
import Form from '@/shared/forms/Form';
import Label from '@/shared/forms/Label';
import Head from '@/shared/Head';
import { useForm, usePage } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import { produce } from 'immer';

type TPage = PageProps<{
  question_form: App.Data.QuestionForm.QuestionFormFullData;
}>;

export default function Show() {
  const { question_form } = usePage<TPage>().props;
  const title = `پاسخ به سوالات ${question_form.title}`;

  const form = useForm({
    answers: question_form.questions.reduce(
      (prev, curr) => {
        prev[curr.id] = '';
        return prev;
      },
      {} as Record<string, string>,
    ),
  });

  const handleSubmit = () => {
    form.post(route('question-forms.answers.store', [question_form.id]));
  };

  return (
    <div className="space-y mt-page container">
      <Head title={title} description={title} />
      <div className="card card-bordered bg-base-100">
        <Form styleMode="base" form={form} onSubmit={handleSubmit} className="card-body">
          <div className="space-y-2 text-center">
            <h1 className="h1">{title}</h1>
          </div>
          {question_form.questions.map((question, i) => {
            const name = question.id.toString();

            return (
              <FieldWrapper
                name={name}
                key={question.id}
                isRequired
                label={{ text: `${digitsEnToFa(i + 1)}- ${question.title}` }}
              >
                <div className="flex flex-col gap-4 py-2">
                  {question.properties.options.map((option, j) => {
                    const id = `${question.id}.${option.value}`;

                    return (
                      <div className="form-control flex-row gap-2" key={option.value}>
                        <input
                          className="radio radio-sm checked:radio-primary"
                          id={id}
                          name={name}
                          onChange={() => {
                            form.setData(
                              produce(form.data, (draft) => {
                                draft.answers[question.id] = option.value;
                              }),
                            );
                          }}
                          type="radio"
                          required
                          value={option.value}
                        />
                        <Label
                          htmlFor={id}
                          label={`${digitsEnToFa(j + 1)}. ${option.label}`}
                          isRequired={false}
                        />
                      </div>
                    );
                  })}
                </div>
              </FieldWrapper>
            );
          })}
          <div>
            <Button
              disabled={form.processing}
              isLoading={form.processing}
              type="submit"
              className="btn btn-primary btn-block lg:w-auto"
            >
              ارسال
            </Button>
          </div>
        </Form>
      </div>
    </div>
  );
}
