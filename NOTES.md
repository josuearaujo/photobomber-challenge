## Photobomber implementation notes

[comment]: <> (Have fun and be creative)

I'd like to start by saying that the project idea is quite interesting and involves many intriguing aspects. However, I may have underestimated the time required to complete it. As you know, I had no prior experience with Vue, Inertia, and Tailwind. This was my first project, so when evaluating it, please consider that it was two days of intense learning. (:

To run the project, simply follow the existing step-by-step process. However, I added a second test user, test@icastgo.com/password, to be able to perform operations with different users.

I also had a significant unexpected issue during development. Unfortunately, I had to develop using a Windows environment because I had no other option. I faced some difficulties in setting up the environment and later with authentication. I'm not entirely sure why, but probably due to the necessity of using Sail within a simulated Ubuntu environment on Windows, I had trouble using Axios to make API calls. This forced me to develop a workaround to proceed with the project. Today, when I removed the workaround to submit the project in its final form to you, authentication mysteriously worked. This only reinforces my belief that the problems I encountered were environment-related at that time.

The project has some structural problems in some areas due to a lack of time resulting from the issues I faced. I didn't have time, for example, to write tests. I was able to at least fix the existing test for the UploadPhotoController since I made some modifications to it. I also had to make minor adjustments to the tests.

Additionally, when implementing the photo deletion feature for example, I couldn't make it more complete by checking if the photo is associated with an album before deleting it or detaching it if necessary.

Another crucial thing I left for the end but ran out of time for is the use of Policies to ensure that each user only has access to their own photos. Essentially, the policy compares the authenticated user's ID with the User_ID found in the requested resource. If they are different, access is not granted.

For endpoints with a bit more logic involved, I would have liked to create services to isolate that logic and enable unit testing. Similarly, on the frontend, I had plans to refactor my components into smaller parts by the end. Unfortunately, I couldn't do so.

I'm writing this text to show that I'm aware of many project limitations, but they could be addressed if I had a bit more time. I also confess that the results would have been better if I had a better familiarity with the involved technologies to avoid spending so much time on minor details.

I'm available to discuss any points if necessary.

Best regards!


