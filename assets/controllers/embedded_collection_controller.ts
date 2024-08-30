import {Controller} from "@hotwired/stimulus";
import {FrameElement, TurboFrameRenderEvent} from "@hotwired/turbo";

export default class extends Controller {

  private boundAfterFrameRenders: any;

  connect() {
    this.boundAfterFrameRenders = this.afterFrameRenders.bind(this);
    document.addEventListener('turbo:frame-render', this.boundAfterFrameRenders);
  }

  disconnect() {
    document.removeEventListener('turbo:frame-render', this.boundAfterFrameRenders)
  }

  afterFrameRenders(event: TurboFrameRenderEvent) {
    const frame = event.target as FrameElement;
    this.createModalWindowsForDeleteActions(frame);
  }

  // Copied from EasyAdmin
  createModalWindowsForDeleteActions(target: HTMLElement) {
    target.querySelectorAll('.action-delete').forEach((actionElement) => {
      actionElement.addEventListener('click', (event) => {
        event.preventDefault();

        target.querySelector('#modal-delete-button')?.addEventListener('click', () => {
          const deleteFormAction = actionElement.getAttribute('formaction') as string;
          const deleteForm: HTMLFormElement = target.querySelector('#delete-form') as HTMLFormElement;
          deleteForm.setAttribute('action', deleteFormAction);
          // use requestSubmit() instead of submit() to trigger the form submit event
          // otherwise turbo won't intercept the form submission
          deleteForm.requestSubmit();
        });
      });
    });
  }

}
