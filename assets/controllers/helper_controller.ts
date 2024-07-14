import {Controller} from "@hotwired/stimulus";
import {TurboFrameMissingEvent} from "@hotwired/turbo";

export default class extends Controller {

  connect() {
    document.addEventListener('turbo:frame-missing', this.onFrameMissing);
  }

  disconnect() {
    document.removeEventListener('turbo:frame-missing', this.onFrameMissing)
  }

  linkToDetailsPage(event: { params: { url: string; }; }) {
    Turbo.visit(event.params.url);
  }

  onFrameMissing(event: TurboFrameMissingEvent) {
    const response: Response = event.detail.response;
    if (response.ok && response.redirected) {
      event.detail.visit(response.url, {action: "advance", frame: undefined});
      event.preventDefault();
    }
    if (!(event.target instanceof HTMLElement)) {
      console.error('Frame is missing');
      return;
    }
    const frame: string = event.target.id;
    if (response.status === 403) {
      event.detail.visit('/login/access-denied', {action: "replace", frame: frame});
      event.preventDefault();
    }
    if (response.status >= 500) {
      event.detail.visit('/login/access-denied', {action: "replace", frame: frame});
      event.preventDefault();
    }
  }

}
