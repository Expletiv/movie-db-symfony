import {Controller} from "@hotwired/stimulus";
import {FrameElement, TurboBeforeFetchResponseEvent, visit} from '@hotwired/turbo';

export default class extends Controller {

  connect() {
    document.addEventListener('turbo:before-fetch-response', this.beforeFetchResponse);
  }

  disconnect() {
    document.removeEventListener('turbo:before-fetch-response', this.beforeFetchResponse)
  }

  linkToDetailsPage(event: { params: { url: string; }; }) {
    visit(event.params.url);
  }

  // see here: https://symfonycasts.com/screencast/turbo/full-frame-redirect
  beforeFetchResponse(event: TurboBeforeFetchResponseEvent) {
    const fetchResponse = event.detail.fetchResponse;
    // @ts-ignore
    if (!fetchResponse.succeeded || !fetchResponse.redirected) {
      return;
    }
    // @ts-ignore
    const frame: ?FrameElement = event.target?.closest('turbo-frame');
    // Add data-turbo-form-redirect to the turbo-frame if you want it to redirect the page
    if (!frame || !frame.dataset.turboFormRedirect) {
      return;
    }

    event.preventDefault();
    Turbo.visit(fetchResponse.location.toString());
  }

}
